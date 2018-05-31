<?php 
/**
 * parser Class
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PSI
 * @author    Michael Cramer <BigMichi1@users.sourceforge.net>
 * @copyright 2009 phpSysInfo
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   SVN: $Id: class.Parser.inc.php 11401 2013-10-28 09:51:30Z sigurdne $
 * @link      http://phpsysinfo.sourceforge.net
 */
 /**
 * parser class with common used parsing metods
 *
 * @category  PHP
 * @package   PSI
 * @author    Michael Cramer <BigMichi1@users.sourceforge.net>
 * @copyright 2009 phpSysInfo
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 3.0
 * @link      http://phpsysinfo.sourceforge.net
 */
class Parser
{
    /**
     * parsing the output of lspci command
     *
     * @return Array
     */
    public static function lspci()
    {
        $arrResults = array();
        if (CommonFunctions::executeProgram("lspci", "", $strBuf, PSI_DEBUG)) {
            $arrLines = preg_split("/\n/", $strBuf, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($arrLines as $strLine) {
                $arrParams = preg_split('/ /', trim($strLine), 2);
                if (count($arrParams) == 2)
                   $strName = $arrParams[1];
                else
                   $strName = "unknown";
                $strName = preg_replace('/\(.*\)/', '', $strName);
                $dev = new HWDevice();
                $dev->setName($strName);
                $arrResults[] = $dev;
            }
        }

        return $arrResults;
    }
    
    /**
     * parsing the output of pciconf command
     *
     * @return Array
     */
    public static function pciconf()
    {
        $arrResults = array();
        $intS = 0;
        if (CommonFunctions::executeProgram("pciconf", "-lv", $strBuf, PSI_DEBUG)) {
            $arrTemp = array();
            $arrLines = preg_split("/\n/", $strBuf, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($arrLines as $strLine) {
                if (preg_match("/(.*) = '(.*)'/", $strLine, $arrParts)) {
                    if (trim($arrParts[1]) == "vendor") {
                        $arrTemp[$intS] = trim($arrParts[2]);
                    } elseif (trim($arrParts[1]) == "device") {
                        $arrTemp[$intS] .= " - ".trim($arrParts[2]);
                        $intS++;
                    }
                }
            }
            foreach ($arrTemp as $name) {
                $dev = new HWDevice();
                $dev->setName($name);
                $arrResults[] = $dev;
            }
        }

        return $arrResults;
    }
    
    /**
     * parsing the output of df command
     *
     * @param string $df_param additional parameter for df command
     *
     * @return array
     */
    public static function df($df_param = "")
    {
        $arrResult = array();
        if (CommonFunctions::executeProgram('df', '-k '.$df_param, $df, PSI_DEBUG)) {
            $df = preg_split("/\n/", $df, -1, PREG_SPLIT_NO_EMPTY);
            if (PSI_SHOW_INODES) {
                if (CommonFunctions::executeProgram('df', '-i '.$df_param, $df2, PSI_DEBUG)) {
                    $df2 = preg_split("/\n/", $df2, -1, PREG_SPLIT_NO_EMPTY);
                    // Store inode use% in an associative array (df_inodes) for later use
                    foreach ($df2 as $df2_line) {
                        if (preg_match("/^(\S+).*\s([0-9]+)%/", $df2_line, $inode_buf)) {
                            $df_inodes[$inode_buf[1]] = $inode_buf[2];
                        }
                    }
                }
            }
            if (CommonFunctions::executeProgram('mount', '', $mount, PSI_DEBUG)) {
                $mount = preg_split("/\n/", $mount, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($mount as $mount_line) {
                    if (preg_match("/\S+ on (\S+) type (.*) \((.*)\)/", $mount_line, $mount_buf)) {
                        $mount_parm[$mount_buf[1]]['fstype'] = $mount_buf[2];
                        if (PSI_SHOW_MOUNT_OPTION) $mount_parm[$mount_buf[1]]['options'] = $mount_buf[3];
                    } elseif (preg_match("/\S+ is (.*) mounted on (\S+) \(type (.*)\)/", $mount_line, $mount_buf)) {
                        $mount_parm[$mount_buf[2]]['fstype'] = $mount_buf[3];
                        if (PSI_SHOW_MOUNT_OPTION) $mount_parm[$mount_buf[2]]['options'] = $mount_buf[1];
                    } elseif (preg_match("/\S+ (.*) on (\S+) \((.*)\)/", $mount_line, $mount_buf)) {
                        $mount_parm[$mount_buf[2]]['fstype'] = $mount_buf[1];
                        if (PSI_SHOW_MOUNT_OPTION) $mount_parm[$mount_buf[2]]['options'] = $mount_buf[3];
                    } elseif (preg_match("/\S+ on ([\S ]+) \((\S+)(,\s(.*))?\)/", $mount_line, $mount_buf)) {
                        $mount_parm[$mount_buf[1]]['fstype'] = $mount_buf[2];
                        if (PSI_SHOW_MOUNT_OPTION) $mount_parm[$mount_buf[1]]['options'] = isset($mount_buf[4]) ? $mount_buf[4] : '';
                    }
                }
                foreach ($df as $df_line) {
                    $df_buf1 = preg_split("/(\%\s)/", $df_line, 3);
                    if (count($df_buf1) < 2) {
                        continue;
                    }
                    if (preg_match("/(.*)(\s+)(([0-9]+)(\s+)([0-9]+)(\s+)([\-0-9]+)(\s+)([0-9]+)$)/", $df_buf1[0], $df_buf2)) {
                        if (count($df_buf1) == 3) {
                            $df_buf = array($df_buf2[1], $df_buf2[4], $df_buf2[6], $df_buf2[8], $df_buf2[10], $df_buf1[2]);
                        } else {
                    $df_buf = array($df_buf2[1], $df_buf2[4], $df_buf2[6], $df_buf2[8], $df_buf2[10], $df_buf1[1]);
                        }
                    if (count($df_buf) == 6) {
                        $df_buf[5] = trim($df_buf[5]);
                        $dev = new DiskDevice();
                        $dev->setName(trim($df_buf[0]));
                        if ($df_buf[2] < 0) {
                            $dev->setTotal($df_buf[3] * 1024);
                            $dev->setUsed($df_buf[3] * 1024);
                        } else {
                            $dev->setTotal($df_buf[1] * 1024);
                            $dev->setUsed($df_buf[2] * 1024);
                                if ($df_buf[3]>0) {
                            $dev->setFree($df_buf[3] * 1024);
                        }
                            }
                            if (PSI_SHOW_MOUNT_POINT) $dev->setMountPoint($df_buf[5]);

                            if (isset($mount_parm[$df_buf[5]])) {
                        $dev->setFsType($mount_parm[$df_buf[5]]['fstype']);
                                if (PSI_SHOW_MOUNT_OPTION) {
                                    if (PSI_SHOW_MOUNT_CREDENTIALS) {
                        $dev->setOptions($mount_parm[$df_buf[5]]['options']);
                                    } else {
                                        $mpo=$mount_parm[$df_buf[5]]['options'];

                                        $mpo=preg_replace('/(^guest,)|(^guest$)|(,guest$)/i', '', $mpo);
                                        $mpo=preg_replace('/,guest,/i', ',', $mpo);

                                        $mpo=preg_replace('/(^user=[^,]*,)|(^user=[^,]*$)|(,user=[^,]*$)/i', '', $mpo);
                                        $mpo=preg_replace('/,user=[^,]*,/i', ',', $mpo);

                                        $mpo=preg_replace('/(^username=[^,]*,)|(^username=[^,]*$)|(,username=[^,]*$)/i', '', $mpo);
                                        $mpo=preg_replace('/,username=[^,]*,/i', ',', $mpo);

                                        $mpo=preg_replace('/(^password=[^,]*,)|(^password=[^,]*$)|(,password=[^,]*$)/i', '', $mpo);
                                        $mpo=preg_replace('/,password=[^,]*,/i', ',', $mpo);

                                        $dev->setOptions($mpo);
                                    }
                                }
                            }
                        if (PSI_SHOW_INODES && isset($df_inodes[trim($df_buf[0])])) {
                            $dev->setPercentInodesUsed($df_inodes[trim($df_buf[0])]);
                        }
                        $arrResult[] = $dev;
                    }
                }
            }
        }
        }

        return $arrResult;
    }
}
