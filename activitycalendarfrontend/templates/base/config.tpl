<!-- BEGIN header -->
<form method="POST" action="{action_url}">
	<table class="pure-table pure-table-bordered">
		<tr bgcolor="{th_bg}">
			<td colspan="2"><font color="{th_text}">&nbsp;<b>{title}</b></font></td>
		</tr>
		<!-- END header -->

		<!-- BEGIN body -->
		<tr bgcolor="{row_on}">
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr bgcolor="{row_off}">
			<td colspan="2"><b>{Registration_settings}</b></td>
		</tr>
		<tr class="pure-table-odd">
			<td>{lang_Use_cookies_to_pass_sessionid}:</td>
			<td>
				<select name="newsettings[usecookies]">
					<option value="">{lang_No}</option>
					<option value="True"{selected_usecookies_True}>{lang_Yes}</option>
				</select>
			</td>
		</tr>
		<tr class="row_on">
			<td>{lang_cookie_domain_for_sessions_-_if_Same_as_framework_leave_empty}</td>
			<td><input name="newsettings[cookie_domain]" value="{value_cookie_domain}"></td>
		</tr>
		<tr bgcolor="{row_off}">
			<td>{lang_ajaxURL}:</td>
			<td><input name="newsettings[AJAXURL]" value="{value_AJAXURL}"></td>
		</tr>
		<tr bgcolor="{row_on}">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="{row_off}">
			<td>{lang_Anonymous_user}:</td>
			<td><input name="newsettings[anonymous_user]" value="{value_anonymous_user}"></td>
		</tr>
		<tr bgcolor="{row_on}">
			<td>{lang_Anonymous_password}:</td>
			<td><input type="password" name="newsettings[anonymous_passwd]" value="{value_anonymous_passwd}"></td>
		</tr>
		<tr bgcolor="{row_off}">
			<td>{lang_allow_test_for_sql_injection}:</td>
			<td>
				<select name="newsettings[allow_test]">
					<option value="" {selected_allow_test_}>NO</option>
					<option value="1" {selected_allow_test_1}>YES</option>
				</select>
			</td>
		</tr>
		<tr bgcolor="{row_on}">

			<!-- END body -->

			<!-- BEGIN footer -->
		<tr bgcolor="{th_bg}">
			<td colspan="2">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="{lang_submit}">
				<input type="submit" name="cancel" value="{lang_cancel}">
			</td>
		</tr>
	</table>
</form>
<!-- END footer -->
