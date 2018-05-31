/*
YUI 3.16.0 (build 76f0e08)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("series-base",function(e,t){e.SeriesBase=e.Base.create("seriesBase",e.Base,[e.Renderer],{render:function(){this._setCanvas(),this.addListeners(),this.validate()},_setCanvas:function(){var e=this.get("graph"),t=e.get("graphic");this.set("graphic",t)},_getChart:function(){var e,t=this.get("graph");return t&&(e=t.get("chart")),e||(e=this.get("graphic")),e},getTotalValues:function(){var e=this.get("direction")==="vertical"?"x":"y",t=this.get(e+"Axis").getTotalByKey(this.get(e+"Key"));return t},_getDefaultStyles:function(){return{padding:{top:0,left:0,right:0,bottom:0}}},_handleVisibleChange:function(){this._toggleVisible(this.get("visible"))},destructor:function(){var t,n=this.get("markers");this.get("rendered")&&(this._stylesChangeHandle&&this._stylesChangeHandle.detach(),this._widthChangeHandle&&this._widthChangeHandle.detach(),this._heightChangeHandle&&this._heightChangeHandle.detach(),this._visibleChangeHandle&&this._visibleChangeHandle.detach());while(n&&n.length>0)t=n.shift(),t&&t instanceof e.Shape&&t.destroy();this._path&&(this._path.destroy(),this._path=null),this._lineGraphic&&(this._lineGraphic.destroy(),this._lineGraphic=null),this._groupMarker&&(this._groupMarker.destroy(),this._groupMarker=null)},_defaultLineColors:["#426ab3","#d09b2c","#000000","#b82837","#b384b5","#ff7200","#779de3","#cbc8ba","#7ed7a6","#007a6c"],_defaultFillColors:["#6084d0","#eeb647","#6c6b5f","#d6484f","#ce9ed1","#ff9f3b","#93b7ff","#e0ddd0","#94ecba","#309687"],_defaultBorderColors:["#205096","#b38206","#000000","#94001e","#9d6fa0","#e55b00","#5e85c9","#adab9e","#6ac291","#006457"],_defaultSliceColors:["#66007f","#a86f41","#295454","#996ab2","#e8cdb7","#90bdbd","#000000","#c3b8ca","#968373","#678585"],_getDefaultColor:function(e,t){var n={line:this._defaultLineColors,fill:this._defaultFillColors,border:this._defaultBorderColors,slice:this._defaultSliceColors},r=n[t]||n.fill,i=r.length;return e=e||0,e>=i&&(e%=i),t=t||"fill",n[t][e]}},{ATTRS:{width:{readOnly:!0,getter:function(){return this.get("graphic").get("width")}},height:{readOnly:!0,getter:function(){return this.get("graphic").get("height")}},graphic:{lazyAdd:!1,setter:function(e){return this.get("rendered")||this.set("rendered",!0),e}},chart:{getter:function(){var e,t=this.get("graph");return t&&(e=t.get("chart")),e}},graph:{},rendered:{value:!1},visible:{value:!0},groupMarkers:{getter:function(){var e,t=this._groupMarkers;return t||(e=this.get("graph"),e&&(t=e.get("groupMarkers"))),t},setter:function(e){return this._groupMarkers=e,e}}}})},"3.16.0",{requires:["graphics","axis-base"]});
