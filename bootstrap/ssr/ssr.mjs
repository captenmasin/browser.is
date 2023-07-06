import { ref, mergeProps, useSSRContext, onMounted, unref, computed, withCtx, openBlock, createBlock, createVNode, toDisplayString, createCommentVNode, createTextVNode, createSSRApp, h } from "vue";
import { ssrRenderAttrs, ssrInterpolate, ssrRenderAttr, ssrRenderComponent, ssrRenderStyle, ssrIncludeBooleanAttr, ssrRenderSlot, ssrRenderClass, ssrRenderList } from "vue/server-renderer";
import CircleProgress from "vue3-circle-progress";
import createServer from "@inertiajs/vue3/server";
import { renderToString } from "@vue/server-renderer";
import { usePage, Head, Link, createInertiaApp } from "@inertiajs/vue3";
const _sfc_main$k = {
  __name: "Home",
  __ssrInlineRender: true,
  setup(__props) {
    const url = ref("");
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "container mx-auto px-4 pb-56" }, _attrs))}>${ssrInterpolate(url.value)} <div class="mt-10 max-w-4xl mx-auto"><input autofocus placeholder="Enter webpage url..." type="text"${ssrRenderAttr("value", url.value)} class="border border-secondary/10 px-8 py-3 w-full focus:border-primary focus:ring-primary rounded-md dark:bg-gray-900 dark:text-white"></div></div>`);
    };
  }
};
const _sfc_setup$k = _sfc_main$k.setup;
_sfc_main$k.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Home.vue");
  return _sfc_setup$k ? _sfc_setup$k(props, ctx) : void 0;
};
const __vite_glob_0_0 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$k
}, Symbol.toStringTag, { value: "Module" }));
function ModifyColour(hexColor, magnitude) {
  hexColor = hexColor.replace(`#`, ``);
  if (hexColor.length === 6) {
    const decimalColor = parseInt(hexColor, 16);
    let r = (decimalColor >> 16) + magnitude;
    r > 255 && (r = 255);
    r < 0 && (r = 0);
    let g = (decimalColor & 255) + magnitude;
    g > 255 && (g = 255);
    g < 0 && (g = 0);
    let b = (decimalColor >> 8 & 255) + magnitude;
    b > 255 && (b = 255);
    b < 0 && (b = 0);
    return `#${(g | b << 8 | r << 16).toString(16)}`;
  } else {
    return hexColor;
  }
}
const _sfc_main$j = {
  __name: "CircleGauge",
  __ssrInlineRender: true,
  props: {
    percent: { type: Number, default: 0 },
    width: { type: Number, default: 180 },
    title: { type: String, default: "" },
    showPercent: { type: Boolean, default: true }
  },
  setup(__props) {
    const props = __props;
    let displayPercent = ref(0);
    let colour = "";
    const colours = [
      {
        name: "bad",
        colour: "#f87171",
        min: 0,
        max: 49
      },
      {
        name: "medium",
        colour: "#fbbf24",
        min: 50,
        max: 89
      },
      {
        name: "good",
        colour: "#4ade80",
        min: 90,
        max: 100
      }
    ];
    colours.forEach((colourObject) => {
      if (props.percent >= colourObject.min && props.percent <= colourObject.max) {
        colour = colourObject.colour;
        ModifyColour(colourObject.colour, -40);
      }
    });
    onMounted(() => {
      setTimeout(function() {
        displayPercent.value = props.percent;
      }, 200);
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "flex w-full justify-center" }, _attrs))}><div class="flex flex-col"><div class="relative">`);
      _push(ssrRenderComponent(unref(CircleProgress), {
        transition: 500,
        percent: unref(displayPercent),
        size: __props.width,
        "fill-color": unref(colour),
        "empty-color": "rgba(0,0,0,0.05)"
      }, null, _parent));
      if (__props.showPercent) {
        _push(`<span class="absolute top-1/2 left-1/2 font-bold -translate-x-1/2 -translate-y-1/2 text-4xl text-primary" style="${ssrRenderStyle({ color: unref(ModifyColour)(unref(colour), -40) })}">${__props.percent}</span>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div><h3 class="font-bold font-heading text-2xl mt-4 text-secondary">${ssrInterpolate(__props.title)}</h3></div></div>`);
    };
  }
};
const _sfc_setup$j = _sfc_main$j.setup;
_sfc_main$j.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/CircleGauge.vue");
  return _sfc_setup$j ? _sfc_setup$j(props, ctx) : void 0;
};
async function SubmitForm(endPoint, preCallback, completedCallback, successCallback, errorCallback) {
  preCallback();
  try {
    const response = await fetch(endPoint);
    if ([500, 403, 419].includes(response.status)) {
      errorCallback("Error: " + response.status);
    } else {
      const results = await response.json();
      if (typeof results.error !== "undefined") {
        errorCallback(results.error);
      } else {
        successCallback(results);
      }
      completedCallback();
    }
  } catch (e) {
    errorCallback(e);
    completedCallback();
  }
}
const _sfc_main$i = {
  __name: "BasicForm",
  __ssrInlineRender: true,
  props: ["modelValue", "error"],
  emits: ["update:modelValue"],
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "mt-10 max-w-4xl mx-auto" }, _attrs))}><form class="flex items-center space-x-4"><div class="w-full"><input autofocus placeholder="Enter webpage url..." type="text"${ssrRenderAttr("value", __props.modelValue)} class="border border-secondary/10 px-8 py-3 w-full focus:border-primary focus:ring-primary rounded-md dark:bg-gray-900 dark:text-white"></div><div><button type="submit"${ssrIncludeBooleanAttr(__props.modelValue === null || __props.modelValue === "") ? " disabled" : ""} class="bg-primary hover:bg-primary-light disabled:pointer-events-none disabled:opacity-50 transition-all text-white py-3 border border-primary rounded-md px-8"> Check </button></div></form><div class="flex justify-between mt-4"><div class="w-8/12">`);
      if (__props.error) {
        _push(`<div class="text-red-500 text-left">${ssrInterpolate(__props.error)}</div>`);
      } else {
        _push(`<!---->`);
      }
      ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
      _push(`</div></div></div>`);
    };
  }
};
const _sfc_setup$i = _sfc_main$i.setup;
_sfc_main$i.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/BasicForm.vue");
  return _sfc_setup$i ? _sfc_setup$i(props, ctx) : void 0;
};
const _sfc_main$h = {
  __name: "LighthouseForm",
  __ssrInlineRender: true,
  props: {
    defaultUrl: { type: String, default: "" }
  },
  setup(__props) {
    const props = __props;
    const lighthouseResults = ref(null);
    const loading = ref(false);
    const error = ref(null);
    const showHtml = ref(false);
    const url = ref(props.defaultUrl);
    async function submit() {
      await SubmitForm(route("api.lighthouse.generate", { url: url.value }), () => {
        loading.value = true;
        error.value = null;
        window.history.pushState("checked", "", route("lighthouse", { url: url.value }));
      }, () => {
        loading.value = false;
      }, (results) => {
        lighthouseResults.value = results;
      }, (errorMessage) => {
        error.value = errorMessage;
      });
    }
    onMounted(() => {
      if (url.value !== null && url.value !== "") {
        submit();
      }
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(_attrs)}>`);
      _push(ssrRenderComponent(_sfc_main$i, {
        onSubmitForm: submit,
        modelValue: url.value,
        "onUpdate:modelValue": ($event) => url.value = $event,
        error: error.value
      }, null, _parent));
      if (lighthouseResults.value) {
        _push(`<div class="w-full"><div class="flex w-full">`);
        _push(ssrRenderComponent(_sfc_main$j, {
          title: "Performance",
          percent: lighthouseResults.value.performance
        }, null, _parent));
        _push(ssrRenderComponent(_sfc_main$j, {
          title: "Accessibility",
          percent: lighthouseResults.value.accessibility
        }, null, _parent));
        _push(ssrRenderComponent(_sfc_main$j, {
          title: "Best practices",
          percent: lighthouseResults.value.practices
        }, null, _parent));
        _push(ssrRenderComponent(_sfc_main$j, {
          title: "SEO",
          percent: lighthouseResults.value.seo
        }, null, _parent));
        _push(ssrRenderComponent(_sfc_main$j, {
          title: "PWA",
          percent: lighthouseResults.value.pwa
        }, null, _parent));
        _push(`</div>`);
        if (!showHtml.value) {
          _push(`<button>See full results</button>`);
        } else {
          _push(`<!---->`);
        }
        if (showHtml.value) {
          _push(`<iframe class="w-full h-[800px] border border-secondary/10 rounded-default"${ssrRenderAttr("src", lighthouseResults.value.html)}></iframe>`);
        } else {
          _push(`<!---->`);
        }
        _push(`</div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup$h = _sfc_main$h.setup;
_sfc_main$h.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/LighthouseForm.vue");
  return _sfc_setup$h ? _sfc_setup$h(props, ctx) : void 0;
};
const _sfc_main$g = {
  __name: "Lighthouse",
  __ssrInlineRender: true,
  props: {
    defaultUrl: { type: String, default: "" },
    title: String,
    description: String
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "container mx-auto px-4 pb-56" }, _attrs))}><div class="text-center"><h1 class="font-heading text-secondary dark:text-white w-full text-5xl md:text-8xl">${__props.title}</h1><p class="mt-8 w-full max-w-2xl tracking-wide text-gray-700 dark:text-white mx-auto font-body-settings">${ssrInterpolate(__props.description)}</p>`);
      _push(ssrRenderComponent(_sfc_main$h, { "default-url": __props.defaultUrl }, null, _parent));
      _push(`</div></div>`);
    };
  }
};
const _sfc_setup$g = _sfc_main$g.setup;
_sfc_main$g.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Lighthouse.vue");
  return _sfc_setup$g ? _sfc_setup$g(props, ctx) : void 0;
};
const __vite_glob_0_1 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$g
}, Symbol.toStringTag, { value: "Module" }));
const _export_sfc = (sfc, props) => {
  const target = sfc.__vccOpts || sfc;
  for (const [key, val] of props) {
    target[key] = val;
  }
  return target;
};
const _sfc_main$f = {};
function _sfc_ssrRender$5(_ctx, _push, _parent, _attrs) {
  _push(`<svg${ssrRenderAttrs(mergeProps(_ctx.$attrs, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24"
  }, _attrs))}><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`);
}
const _sfc_setup$f = _sfc_main$f.setup;
_sfc_main$f.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Global/LoadingSpinner.vue");
  return _sfc_setup$f ? _sfc_setup$f(props, ctx) : void 0;
};
const LoadingSpinner = /* @__PURE__ */ _export_sfc(_sfc_main$f, [["ssrRender", _sfc_ssrRender$5]]);
const _sfc_main$e = {};
function _sfc_ssrRender$4(_ctx, _push, _parent, _attrs) {
  _push(`<svg${ssrRenderAttrs(mergeProps({
    viewBox: "0 0 36 36",
    fill: "none",
    role: "img",
    xmlns: "http://www.w3.org/2000/svg",
    width: "240",
    height: "240"
  }, _attrs))}><mask id="mask__beam" maskUnits="userSpaceOnUse" x="0" y="0" width="36" height="36"><rect width="36" height="36" rx="" fill="#FFFFFF"></rect></mask><g mask="url(#mask__beam)"><rect width="36" height="36" fill="#005aff"></rect><rect x="0" y="0" width="36" height="36" transform="translate(9 -5) rotate(299 18 18) scale(1.2)" fill="#f87171" rx="6"></rect><g transform="
                    translate(4.5 -2)
                    rotate(-9 18 18)
                    "><path d="M15 21c2 1 4 1 6 0" stroke="#000000" fill="none" strokeLinecap="round"></path><rect x="10" y="14" width="1.5" height="2" rx="1" stroke="none" fill="#000000"></rect><rect x="24" y="14" width="1.5" height="2" rx="1" stroke="none" fill="#000000"></rect></g></g></svg>`);
}
const _sfc_setup$e = _sfc_main$e.setup;
_sfc_main$e.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Global/DefaultAvatar.vue");
  return _sfc_setup$e ? _sfc_setup$e(props, ctx) : void 0;
};
const DefaultAvatar = /* @__PURE__ */ _export_sfc(_sfc_main$e, [["ssrRender", _sfc_ssrRender$4]]);
const _sfc_main$d = {
  __name: "Facebook",
  __ssrInlineRender: true,
  props: {
    meta: Object
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "w-full border bg-white dark:bg-[#242526] dark:border-gray-900 shadow-sm mx-auto p-4 text-left rounded-default pb-4 font-system relative" }, _attrs))}>`);
      if (__props.meta) {
        _push(`<div><div class="flex flex-row items-center h-full space-x-5"><div class="w-16 bg-gray-200 h-16 rounded-full overflow-hidden">`);
        _push(ssrRenderComponent(DefaultAvatar, { class: "w-full h-full" }, null, _parent));
        _push(`</div><div class="flex flex-col"><div class="text-secondary dark:text-white font-[600] cursor-pointer"> John Doe </div><div class="text-gray-500 dark:text-white text-sm -mt-1"> Just now </div></div></div><div class="-mx-4 mt-4 border-t border-b border-[#e5e5e5] dark:border-0 cursor-pointer">`);
        if (__props.meta.image) {
          _push(`<div class="aspect-[500/261]"><img${ssrRenderAttr("src", __props.meta.image)} class="w-full"></div>`);
        } else {
          _push(`<!---->`);
        }
        _push(`<div class="${ssrRenderClass([!__props.meta.image ? "pt-2" : null, "w-full py-2 px-4 bg-[#f0f2f5] dark:bg-[#3a3b3c] flex flex-col"])}"><div class="uppercase text-[13px] dark:text-[#b1b3b9] text-[#65676B] mb-px">${ssrInterpolate(__props.meta.domain)}</div><div class="text-[17px] text-[#050505] dark:text-white font-semibold">${ssrInterpolate(__props.meta.title)}</div><div class="w-full truncate text-[15px] dark:text-[#b1b3b9] text-[#65676B]">${ssrInterpolate(__props.meta.description)}</div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      if (!__props.meta) {
        _push(`<div><div class="flex flex-row items-center h-full space-x-5"><div class="w-16 bg-gray-200 h-16 dark:bg-[#8a98a5] rounded-full"></div><div class="flex flex-col space-y-3"><div class="w-36 bg-gray-200 dark:bg-[#8a98a5] h-3"></div><div class="w-24 bg-gray-200 dark:bg-[#8a98a5] h-3"></div></div></div><div class="flex items-center mt-4 w-full pb-32"><div class="flex flex-col space-y-3 w-full"><div class="w-10/12 bg-gray-200 dark:bg-[#8a98a5] h-3"></div><div class="w-full bg-gray-200 dark:bg-[#8a98a5] h-3"></div><div class="w-4/12 bg-gray-200 dark:bg-[#8a98a5] h-3"></div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup$d = _sfc_main$d.setup;
_sfc_main$d.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Previews/Facebook.vue");
  return _sfc_setup$d ? _sfc_setup$d(props, ctx) : void 0;
};
const _sfc_main$c = {};
function _sfc_ssrRender$3(_ctx, _push, _parent, _attrs) {
  _push(`<svg${ssrRenderAttrs(mergeProps({
    xmlns: "http://www.w3.org/2000/svg",
    viewBox: "0 0 512 512"
  }, _attrs))}><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>`);
}
const _sfc_setup$c = _sfc_main$c.setup;
_sfc_main$c.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Icons/TwitterIcon.vue");
  return _sfc_setup$c ? _sfc_setup$c(props, ctx) : void 0;
};
const TwitterIcon = /* @__PURE__ */ _export_sfc(_sfc_main$c, [["ssrRender", _sfc_ssrRender$3]]);
const _sfc_main$b = {
  __name: "Twitter",
  __ssrInlineRender: true,
  props: {
    meta: Object
  },
  setup(__props) {
    const props = __props;
    const smallImage = computed(() => {
      return props.meta.imageWidth <= 250 || !props.meta.image;
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({
        class: ["w-full border group bg-white transition-all dark:border-gray-900 shadow-sm dark:bg-[#15202b] mx-auto p-4 text-left rounded-default pb-4 font-system relative", __props.meta ? "hover:bg-[#f7f7f7] dark:hover:bg-[#1c2732]" : null]
      }, _attrs))}><div class="absolute top-0 right-0 p-6">`);
      _push(ssrRenderComponent(TwitterIcon, { class: "text-[#00acee] w-6 h-6" }, null, _parent));
      _push(`</div>`);
      if (__props.meta) {
        _push(`<div><div class="flex flex-row h-full space-x-3"><div class="w-12 bg-gray-200 h-12 rounded-full overflow-hidden cursor-pointer">`);
        _push(ssrRenderComponent(DefaultAvatar, { class: "w-full h-full" }, null, _parent));
        _push(`</div><div class="flex flex-col mt-1"><div class="text-[15px] cursor-pointer"><span class="text-[#0f1419] dark:text-white font-[800]"> John Doe </span><span class="text-[#536471] dark:text-[#8a98a5]"><span class="hover:underline">@jdoe</span> · 1m</span></div></div></div><div class="mt-4 border border-[#cfd9de] dark:border-[#37444d] rounded-xl overflow-hidden cursor-pointer"><div class="${ssrRenderClass([!smallImage.value ? "flex-col" : "flex-row", "flex"])}">`);
        if (__props.meta.image && !smallImage.value) {
          _push(`<div class="aspect-[500/261]"><img${ssrRenderAttr("src", __props.meta.image)} class="w-full"></div>`);
        } else {
          _push(`<!---->`);
        }
        if (smallImage.value) {
          _push(`<div class="aspect-square border-r bg-cover bg-center border-[#cfd9de] dark:border-[#37444d] shrink-0 w-32 bg-[#f7f9f9] flex justify-center items-center" style="${ssrRenderStyle({ backgroundImage: __props.meta.image ? "url('" + __props.meta.image + "')" : null })}">`);
          if (!__props.meta.image) {
            _push(`<svg viewBox="0 0 24 24" aria-hidden="true" class="w-8 h-8 text-[#536471]"><g><path d="M1.998 5.5c0-1.38 1.119-2.5 2.5-2.5h15c1.381 0 2.5 1.12 2.5 2.5v13c0 1.38-1.119 2.5-2.5 2.5h-15c-1.381 0-2.5-1.12-2.5-2.5v-13zm2.5-.5c-.276 0-.5.22-.5.5v13c0 .28.224.5.5.5h15c.276 0 .5-.22.5-.5v-13c0-.28-.224-.5-.5-.5h-15zM6 7h6v6H6V7zm2 2v2h2V9H8zm10 0h-4V7h4v2zm0 4h-4v-2h4v2zm-.002 4h-12v-2h12v2z"></path></g></svg>`);
          } else {
            _push(`<!---->`);
          }
          _push(`</div>`);
        } else {
          _push(`<!---->`);
        }
        _push(`<div class="${ssrRenderClass([[!__props.meta.image ? "pt-2 justify-center pl-3" : "", smallImage.value ? "justify-center" : ""], "w-full py-2 px-2 bg-transparent transition-all group-hover:bg-[#efefef] dark:group-hover:bg-[#1c2732] flex flex-col"])}" style="${ssrRenderStyle(smallImage.value ? "width:calc(100% - 8rem);" : "")}"><div class="text-[15px] text-[#536471] dark:text-[#8a98a5] mb-px">${ssrInterpolate(__props.meta.domain)}</div><div class="text-[15px] text-[#0f1419] dark:text-white">${ssrInterpolate(__props.meta.title)}</div><div class="w-full line-clamp-2 break-words text-[15px] dark:text-[#8a98a5] leading-[20px] text-[#65676B]">${ssrInterpolate(__props.meta.description)}</div></div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      if (!__props.meta) {
        _push(`<div><div class="flex flex-row items-center h-full space-x-5"><div class="w-16 bg-gray-200 dark:bg-[#8a98a5] h-16 rounded-full"></div><div class="flex flex-col space-y-3"><div class="w-36 bg-gray-200 dark:bg-[#8a98a5] h-3"></div><div class="w-24 bg-gray-200 dark:bg-[#8a98a5] h-3"></div></div></div><div class="flex items-center mt-4 w-full pb-24"><div class="flex flex-col space-y-3 w-full"><div class="w-10/12 bg-gray-200 dark:bg-[#8a98a5] h-3"></div><div class="w-full bg-gray-200 dark:bg-[#8a98a5] h-3"></div><div class="w-4/12 bg-gray-200 dark:bg-[#8a98a5] h-3"></div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup$b = _sfc_main$b.setup;
_sfc_main$b.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Previews/Twitter.vue");
  return _sfc_setup$b ? _sfc_setup$b(props, ctx) : void 0;
};
const _sfc_main$a = {
  __name: "Whatsapp",
  __ssrInlineRender: true,
  props: {
    meta: Object
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "w-full border shadow-sm dark:border-gray-900 bg-[#d9fdd2] dark:bg-[#015c4b] mx-auto p-1 text-left rounded-[7.5px] pb-4 font-system relative" }, _attrs))}>`);
      if (__props.meta) {
        _push(`<div><div class="w-full"><div class="w-full bg-[#d1f4cc] dark:bg-[#025143] p-2 rounded-[6px] overflow-hidden flex cursor-pointer">`);
        if (__props.meta.image) {
          _push(`<div class="aspect-square -m-2 bg-cover bg-center shrink-0 w-24 bg-[#f7f9f9] flex justify-center items-center" style="${ssrRenderStyle({ backgroundImage: __props.meta.image ? "url('" + __props.meta.image + "')" : null })}"></div>`);
        } else {
          _push(`<!---->`);
        }
        _push(`<div class="${ssrRenderClass([__props.meta.image ? "ml-4" : "", "flex flex-col w-full"])}"><div class="text-[13px] text-[#111b21] dark:text-white opacity-[0.87]">${ssrInterpolate(__props.meta.title)}</div><div class="w-full line-clamp-2 break-words dark:text-white text-[12px] leading-[19px] text-[#111b21] opacity-[0.6] whitespace-normal">${ssrInterpolate(__props.meta.description)}</div><div class="w-full text-[15px]text-[#65676B] dark:text-white text-[12px] text-[#111b21] opacity-[0.3]">${ssrInterpolate(__props.meta.domain)}</div></div></div><div class="w-24 text-[#027eb5] dark:text-[#53bdeb] px-2 mt-1 text-[14.2px] truncate w-full cursor-pointer hover:underline">${ssrInterpolate(__props.meta.url)}</div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      if (!__props.meta) {
        _push(`<div><div class="w-full"><div class="w-full bg-[#d1f4cc] dark:bg-[#025143] p-2 rounded-[6px]"><div class="flex flex-col space-y-2"><div class="w-36 bg-secondary/10 dark:bg-white/10 rounded-full h-2"></div><div class="w-full bg-secondary/10 dark:bg-white/10 rounded-full h-2"></div><div class="w-56 bg-secondary/10 dark:bg-white/10 rounded-full h-2"></div><div class="w-12 bg-secondary/5 dark:bg-white/10 rounded-full h-2"></div></div></div><div class="w-24 bg-[#027eb5] dark:bg-[#53bdeb] opacity-50 rounded-full h-2 ml-2 mt-2"></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup$a = _sfc_main$a.setup;
_sfc_main$a.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Previews/Whatsapp.vue");
  return _sfc_setup$a ? _sfc_setup$a(props, ctx) : void 0;
};
const _sfc_main$9 = {
  __name: "Teams",
  __ssrInlineRender: true,
  props: {
    meta: Object
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "w-full border bg-[#e9ebfa] dark:bg-[#2f2f4a] dark:border-gray-900 shadow-sm mx-auto p-4 text-left rounded-[7.5px] pb-4 font-system relative" }, _attrs))}>`);
      if (__props.meta) {
        _push(`<div><div class="w-full"><div class="w-36 text-[#5254b3] dark:text-[#7f85f5] mb-2 cursor-pointer hover:underline">${ssrInterpolate(__props.meta.url)}</div><div class="w-full bg-white dark:bg-[#242424] flex rounded-[6px] overflow-hidden cursor-pointer">`);
        if (__props.meta.image) {
          _push(`<div class="bg-cover bg-center shrink-0 w-36 bg-black/10 flex justify-center items-center" style="${ssrRenderStyle({ backgroundImage: __props.meta.image ? "url('" + __props.meta.image + "')" : null })}"></div>`);
        } else {
          _push(`<!---->`);
        }
        _push(`<div class="flex flex-col p-3 w-full"><div class="text-lg font-semibold">${ssrInterpolate(__props.meta.title)}</div><div class="w-full line-clamp-2 break-words text-[#242424] dark:text-white leading-[20px] whitespace-normal">${ssrInterpolate(__props.meta.description)}</div><div class="mt-auto text-[#242424] opacity-50 dark:text-white text-sm pt-2">${ssrInterpolate(__props.meta.domain)}</div></div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      if (!__props.meta) {
        _push(`<div><div class="w-full"><div class="w-36 bg-[#5254b3] dark:bg-[#7f85f5] opacity-50 rounded-full h-3 mb-2"></div><div class="w-full bg-white dark:bg-[#242424] flex rounded-[6px] overflow-hidden"><div class="aspect-[19/15] bg-cover bg-center shrink-0 w-32 bg-black/10 flex justify-center items-center"></div><div class="flex flex-col p-4"><div class="w-36 bg-secondary/10 bg-white/10 rounded-full h-3"></div><div class="w-full bg-secondary/10 bg-white/10 rounded-full h-2 mt-2"></div><div class="w-56 bg-secondary/10 bg-white/10 rounded-full h-2 mt-2"></div><div class="w-12 bg-secondary/5 bg-white/5 rounded-full h-2 mt-auto"></div></div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup$9 = _sfc_main$9.setup;
_sfc_main$9.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Previews/Teams.vue");
  return _sfc_setup$9 ? _sfc_setup$9(props, ctx) : void 0;
};
const _sfc_main$8 = {
  __name: "OpenGraphResults",
  __ssrInlineRender: true,
  props: {
    loading: Boolean,
    metadata: Object,
    url: String
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(_attrs)}><h3 class="font-heading dark:text-white text-2xl text-gray-500 flex text-left mt-12 mx-auto">`);
      if (__props.loading) {
        _push(`<!--[-->`);
        _push(ssrRenderComponent(LoadingSpinner, { class: "w-6 text-primary animate-spin mr-4" }, null, _parent));
        _push(` Generating previews <!--]-->`);
      } else {
        _push(`<!--[--> Previews <!--]-->`);
      }
      _push(`</h3><div class="text-left flex items-center text-sm text-gray-700 mt-2"><div class="mr-4"> Share results </div><ul class="flex space-x-3" id="share-button-list"><li><a${ssrRenderAttr("href", "https://www.facebook.com/sharer/sharer.php?u=" + _ctx.route("home", { url: __props.url }))} target="_blank" class="text-secondary mx-auto flex h-4 w-4 items-center rounded-full transition-all hover:text-[#1877F2]"><span class="sr-only">Share to Facebook</span><svg class="w-full" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg></a></li><li><a${ssrRenderAttr("href", "https://twitter.com/intent/tweet?text=OpenGraph Checker results - SEOtoolkit&url=" + encodeURIComponent(_ctx.route("home", { url: __props.url })))} target="_blank" class="text-secondary mx-auto flex h-4 w-4 items-center rounded-full transition-all hover:text-[#1DA1F2]"><span class="sr-only">Share to Twitter</span><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-full" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg></a></li><li><a${ssrRenderAttr("href", "https://api.whatsapp.com/send/?text=OpenGraph Checker results - SEOtoolkit+" + _ctx.route("home", { url: __props.url }))} target="_blank" class="text-secondary mx-auto flex h-4 w-4 items-center rounded-full transition-all hover:text-[#25d366]"><span class="sr-only">Share to WhatsApp</span><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-full" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg></a></li><li><a${ssrRenderAttr("href", "https://www.linkedin.com/sharing/share-offsite/?url=" + _ctx.route("home", { url: __props.url }) + "&title=OpenGraph Checker results - SEOtoolkit")} target="_blank" class="text-secondary mx-auto flex h-4 w-4 items-center rounded-full transition-all hover:text-[#0A66C2]"><span class="sr-only">Share to LinkedIn</span><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-full" viewBox="0 0 448 512"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path></svg></a></li></ul></div><div class="flex flex-wrap text-left dark:text-white items-start justify-center mt-4 -mx-2"><div class="w-full md:w-1/3 p-2"><strong>Facebook</strong>`);
      _push(ssrRenderComponent(_sfc_main$d, { meta: __props.metadata }, null, _parent));
      _push(`</div><div class="w-full md:w-1/3 p-2"><strong>Twitter</strong>`);
      _push(ssrRenderComponent(_sfc_main$b, { meta: __props.metadata }, null, _parent));
      _push(`</div><div class="w-full md:w-1/3 p-2 flex flex-col"><strong>WhatsApp</strong>`);
      _push(ssrRenderComponent(_sfc_main$a, { meta: __props.metadata }, null, _parent));
      _push(`<strong class="mt-4">MS Teams</strong>`);
      _push(ssrRenderComponent(_sfc_main$9, { meta: __props.metadata }, null, _parent));
      _push(`</div></div></div>`);
    };
  }
};
const _sfc_setup$8 = _sfc_main$8.setup;
_sfc_main$8.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/OpenGraphResults.vue");
  return _sfc_setup$8 ? _sfc_setup$8(props, ctx) : void 0;
};
const _sfc_main$7 = {
  __name: "OpenGraphForm",
  __ssrInlineRender: true,
  props: {
    defaultUrl: { type: String, default: "" }
  },
  setup(__props) {
    const props = __props;
    const metadata = ref(null);
    const loading = ref(false);
    const error = ref(null);
    const url = ref(props.defaultUrl);
    async function submit() {
      await SubmitForm(route("api.metadata.generate", { url: url.value }), () => {
        loading.value = true;
        error.value = null;
        window.history.pushState("checked", "", route("home", { url: url.value }));
      }, () => {
        loading.value = false;
      }, (results) => {
        metadata.value = results;
      }, (errorMessage) => {
        error.value = errorMessage;
      });
    }
    onMounted(() => {
      if (url.value !== null && url.value !== "") {
        submit();
      }
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(_attrs)}>`);
      _push(ssrRenderComponent(_sfc_main$i, {
        onSubmitForm: submit,
        modelValue: url.value,
        "onUpdate:modelValue": ($event) => url.value = $event,
        error: error.value
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            if (metadata.value && !error.value) {
              _push2(`<details class="text-left px-2 dark:text-white"${_scopeId}><summary class="cursor-pointer text-gray-500 select-none"${_scopeId}>Extracted meta (json)</summary><div class="w-full overflow-auto"${_scopeId}><code class="text-left"${_scopeId}><pre${_scopeId}>${ssrInterpolate(metadata.value)}</pre></code></div></details>`);
            } else {
              _push2(`<!---->`);
            }
          } else {
            return [
              metadata.value && !error.value ? (openBlock(), createBlock("details", {
                key: 0,
                class: "text-left px-2 dark:text-white"
              }, [
                createVNode("summary", { class: "cursor-pointer text-gray-500 select-none" }, "Extracted meta (json)"),
                createVNode("div", { class: "w-full overflow-auto" }, [
                  createVNode("code", { class: "text-left" }, [
                    createVNode("pre", null, toDisplayString(metadata.value), 1)
                  ])
                ])
              ])) : createCommentVNode("", true)
            ];
          }
        }),
        _: 1
      }, _parent));
      if (metadata.value || loading.value) {
        _push(ssrRenderComponent(_sfc_main$8, {
          loading: loading.value,
          metadata: metadata.value,
          url: url.value
        }, null, _parent));
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup$7 = _sfc_main$7.setup;
_sfc_main$7.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/OpenGraphForm.vue");
  return _sfc_setup$7 ? _sfc_setup$7(props, ctx) : void 0;
};
const _sfc_main$6 = {
  __name: "OpenGraph",
  __ssrInlineRender: true,
  props: {
    defaultUrl: { type: String, default: "" },
    title: String,
    description: String
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "container mx-auto px-4 pb-56" }, _attrs))}><div class="text-center"><h1 class="font-heading text-secondary dark:text-white w-full text-5xl md:text-8xl">${__props.title}</h1><p class="mt-8 w-full max-w-2xl tracking-wide text-gray-700 dark:text-white mx-auto font-body-settings">${ssrInterpolate(__props.description)}</p>`);
      _push(ssrRenderComponent(_sfc_main$7, { "default-url": __props.defaultUrl }, null, _parent));
      _push(`</div></div>`);
    };
  }
};
const _sfc_setup$6 = _sfc_main$6.setup;
_sfc_main$6.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/OpenGraph.vue");
  return _sfc_setup$6 ? _sfc_setup$6(props, ctx) : void 0;
};
const __vite_glob_0_2 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$6
}, Symbol.toStringTag, { value: "Module" }));
const app = "";
const fonts = "";
const _sfc_main$5 = {
  __name: "MetaHead",
  __ssrInlineRender: true,
  setup(__props) {
    const meta = usePage().props.meta;
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(unref(Head), mergeProps({
        title: unref(meta).title,
        description: unref(meta).description
      }, _attrs), null, _parent));
    };
  }
};
const _sfc_setup$5 = _sfc_main$5.setup;
_sfc_main$5.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/MetaHead.vue");
  return _sfc_setup$5 ? _sfc_setup$5(props, ctx) : void 0;
};
const _sfc_main$4 = {};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs) {
  _push(`<svg${ssrRenderAttrs(mergeProps({
    viewBox: "0 0 595 118",
    fill: "none",
    xmlns: "http://www.w3.org/2000/svg"
  }, _attrs))}><path d="M159.712 96.44C154.848 96.44 150.624 95.512 147.04 93.656C143.52 91.8 140.16 89.176 136.96 85.784L144.64 77.528C147.2 80.216 149.728 82.232 152.224 83.576C154.72 84.92 157.28 85.592 159.904 85.592C161.632 85.592 163.168 85.272 164.512 84.632C165.856 83.992 166.912 83.128 167.68 82.04C168.448 80.952 168.832 79.704 168.832 78.296C168.832 76.696 168.448 75.288 167.68 74.072C166.912 72.792 165.568 71.608 163.648 70.52L149.248 61.688C145.728 59.512 143.104 57.048 141.376 54.296C139.648 51.48 138.784 48.344 138.784 44.888C138.784 41.432 139.616 38.328 141.28 35.576C143.008 32.76 145.376 30.52 148.384 28.856C151.392 27.192 154.816 26.36 158.656 26.36C162.816 26.36 166.496 27.16 169.696 28.76C172.896 30.296 175.776 32.344 178.336 34.904L170.752 43.16C168.832 41.304 166.88 39.864 164.896 38.84C162.912 37.752 160.768 37.208 158.464 37.208C156.928 37.208 155.552 37.528 154.336 38.168C153.184 38.808 152.288 39.64 151.648 40.664C151.008 41.688 150.688 42.84 150.688 44.12C150.688 45.72 151.072 47.128 151.84 48.344C152.608 49.56 153.92 50.776 155.776 51.992L170.272 60.728C173.856 62.904 176.48 65.4 178.144 68.216C179.872 71.032 180.736 74.136 180.736 77.528C180.736 81.176 179.84 84.44 178.048 87.32C176.32 90.136 173.856 92.376 170.656 94.04C167.52 95.64 163.872 96.44 159.712 96.44ZM231.547 95H187.771V27.8H231.547V38.648H199.771V55.16H223.195V65.816H199.771V84.152H231.547V95ZM270.213 96.44C265.285 96.44 260.677 95.544 256.389 93.752C252.101 91.896 248.325 89.368 245.061 86.168C241.861 82.968 239.333 79.256 237.477 75.032C235.685 70.744 234.789 66.2 234.789 61.4C234.789 56.6 235.685 52.088 237.477 47.864C239.333 43.576 241.861 39.832 245.061 36.632C248.325 33.432 252.101 30.936 256.389 29.144C260.677 27.288 265.285 26.36 270.213 26.36C275.141 26.36 279.749 27.288 284.037 29.144C288.389 30.936 292.165 33.432 295.365 36.632C298.629 39.832 301.157 43.576 302.949 47.864C304.805 52.088 305.733 56.6 305.733 61.4C305.733 66.2 304.805 70.744 302.949 75.032C301.157 79.256 298.629 82.968 295.365 86.168C292.165 89.368 288.389 91.896 284.037 93.752C279.749 95.544 275.141 96.44 270.213 96.44ZM270.213 85.304C273.477 85.304 276.517 84.728 279.333 83.576C282.149 82.36 284.613 80.664 286.725 78.488C288.901 76.312 290.565 73.784 291.717 70.904C292.933 67.96 293.541 64.792 293.541 61.4C293.541 58.008 292.933 54.872 291.717 51.992C290.565 49.048 288.901 46.488 286.725 44.312C284.613 42.136 282.149 40.472 279.333 39.32C276.517 38.104 273.477 37.496 270.213 37.496C267.013 37.496 264.005 38.104 261.189 39.32C258.373 40.472 255.877 42.136 253.701 44.312C251.589 46.488 249.925 49.048 248.709 51.992C247.557 54.872 246.981 58.008 246.981 61.4C246.981 64.792 247.557 67.96 248.709 70.904C249.925 73.784 251.589 76.312 253.701 78.488C255.813 80.664 258.277 82.36 261.093 83.576C263.973 84.728 267.013 85.304 270.213 85.304Z" class="text-primary" fill="currentColor"></path><path d="M334.493 57.848H326.717V47.672H334.493V33.56H346.301V47.672H356.573V57.848H346.301V80.6C346.301 81.944 346.685 83.032 347.453 83.864C348.285 84.696 349.405 85.112 350.813 85.112C351.709 85.112 352.477 85.016 353.117 84.824C353.821 84.568 354.461 84.216 355.037 83.768L358.397 93.08C357.117 93.784 355.709 94.36 354.173 94.808C352.701 95.256 351.037 95.48 349.181 95.48C344.637 95.48 341.053 94.232 338.429 91.736C335.805 89.176 334.493 85.624 334.493 81.08V57.848ZM385.851 96.248C380.987 96.248 376.603 95.16 372.699 92.984C368.859 90.744 365.787 87.736 363.483 83.96C361.243 80.184 360.123 75.992 360.123 71.384C360.123 66.712 361.243 62.488 363.483 58.712C365.787 54.936 368.859 51.96 372.699 49.784C376.603 47.544 380.987 46.424 385.851 46.424C390.651 46.424 395.003 47.544 398.907 49.784C402.811 51.96 405.883 54.936 408.123 58.712C410.427 62.488 411.579 66.68 411.579 71.288C411.579 75.96 410.427 80.184 408.123 83.96C405.883 87.736 402.811 90.744 398.907 92.984C395.003 95.16 390.651 96.248 385.851 96.248ZM385.755 85.88C388.507 85.88 390.939 85.24 393.051 83.96C395.227 82.68 396.923 80.952 398.139 78.776C399.355 76.536 399.963 74.04 399.963 71.288C399.963 68.536 399.355 66.072 398.139 63.896C396.923 61.72 395.227 59.992 393.051 58.712C390.939 57.432 388.507 56.792 385.755 56.792C383.131 56.792 380.731 57.432 378.555 58.712C376.443 59.992 374.747 61.72 373.467 63.896C372.251 66.072 371.643 68.568 371.643 71.384C371.643 74.136 372.251 76.6 373.467 78.776C374.747 80.952 376.443 82.68 378.555 83.96C380.731 85.24 383.131 85.88 385.755 85.88ZM442.383 96.248C437.519 96.248 433.135 95.16 429.231 92.984C425.391 90.744 422.319 87.736 420.015 83.96C417.775 80.184 416.655 75.992 416.655 71.384C416.655 66.712 417.775 62.488 420.015 58.712C422.319 54.936 425.391 51.96 429.231 49.784C433.135 47.544 437.519 46.424 442.383 46.424C447.183 46.424 451.535 47.544 455.439 49.784C459.343 51.96 462.415 54.936 464.655 58.712C466.959 62.488 468.111 66.68 468.111 71.288C468.111 75.96 466.959 80.184 464.655 83.96C462.415 87.736 459.343 90.744 455.439 92.984C451.535 95.16 447.183 96.248 442.383 96.248ZM442.286 85.88C445.039 85.88 447.471 85.24 449.583 83.96C451.759 82.68 453.455 80.952 454.671 78.776C455.887 76.536 456.495 74.04 456.495 71.288C456.495 68.536 455.887 66.072 454.671 63.896C453.455 61.72 451.759 59.992 449.583 58.712C447.471 57.432 445.039 56.792 442.286 56.792C439.663 56.792 437.263 57.432 435.087 58.712C432.975 59.992 431.279 61.72 429.999 63.896C428.783 66.072 428.174 68.568 428.174 71.384C428.174 74.136 428.783 76.6 429.999 78.776C431.279 80.952 432.975 82.68 435.087 83.96C437.263 85.24 439.663 85.88 442.286 85.88ZM487.01 95H475.202V24.44H487.01V95ZM507.53 95H495.722V24.44H507.53V95ZM539.978 47.672L520.202 66.776L517.61 68.216L500.426 85.496L506.378 66.776L525.482 47.672H539.978ZM541.226 95H528.362L510.026 64.184L521.93 64.088L541.226 95ZM557.226 95H545.418V47.672H557.226V95ZM544.17 34.712C544.17 33.368 544.458 32.152 545.034 31.064C545.674 29.976 546.538 29.112 547.626 28.472C548.714 27.832 549.962 27.512 551.37 27.512C552.714 27.512 553.93 27.832 555.018 28.472C556.106 29.112 556.938 29.976 557.514 31.064C558.154 32.152 558.474 33.336 558.474 34.616C558.474 35.96 558.154 37.176 557.514 38.264C556.938 39.352 556.106 40.216 555.018 40.856C553.93 41.496 552.714 41.816 551.37 41.816C550.026 41.816 548.778 41.496 547.626 40.856C546.538 40.216 545.674 39.384 545.034 38.36C544.458 37.272 544.17 36.056 544.17 34.712ZM570.743 57.848H562.967V47.672H570.743V33.56H582.551V47.672H592.823V57.848H582.551V80.6C582.551 81.944 582.935 83.032 583.703 83.864C584.535 84.696 585.655 85.112 587.063 85.112C587.959 85.112 588.727 85.016 589.367 84.824C590.071 84.568 590.711 84.216 591.287 83.768L594.647 93.08C593.367 93.784 591.959 94.36 590.423 94.808C588.951 95.256 587.287 95.48 585.431 95.48C580.887 95.48 577.303 94.232 574.679 91.736C572.055 89.176 570.743 85.624 570.743 81.08V57.848Z" class="text-secondary" fill="currentColor"></path><g clip-path="url(#clip0_5_22)"><path fill-rule="evenodd" clip-rule="evenodd" d="M83.008 86.008C85.686 83.331 90.028 83.331 92.706 86.008L110.992 104.294C113.669 106.972 113.669 111.314 110.992 113.992C108.314 116.669 103.972 116.669 101.294 113.992L83.008 95.706C80.331 93.028 80.331 88.686 83.008 86.008Z" class="text-primary" fill="currentColor"></path><path d="M46 89C68.0914 89 86 71.0914 86 49C86 26.9086 68.0914 9 46 9C23.9086 9 6 26.9086 6 49C6 71.0914 23.9086 89 46 89Z" class="text-primary" fill="currentColor" fill-opacity="0.5" stroke="currentColor" stroke-width="12" stroke-linecap="round"></path></g><defs><clipPath id="clip0_5_22"><rect width="113" height="113" fill="white" transform="translate(0 3)"></rect></clipPath></defs></svg>`);
}
const _sfc_setup$4 = _sfc_main$4.setup;
_sfc_main$4.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Global/AppLogo.vue");
  return _sfc_setup$4 ? _sfc_setup$4(props, ctx) : void 0;
};
const AppLogo = /* @__PURE__ */ _export_sfc(_sfc_main$4, [["ssrRender", _sfc_ssrRender$2]]);
const _sfc_main$3 = {};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs) {
  _push(`<svg${ssrRenderAttrs(mergeProps({
    viewBox: "0 0 595 118",
    fill: "none",
    xmlns: "http://www.w3.org/2000/svg"
  }, _attrs))}><path d="M159.712 96.44C154.848 96.44 150.624 95.512 147.04 93.656C143.52 91.8 140.16 89.176 136.96 85.784L144.64 77.528C147.2 80.216 149.728 82.232 152.224 83.576C154.72 84.92 157.28 85.592 159.904 85.592C161.632 85.592 163.168 85.272 164.512 84.632C165.856 83.992 166.912 83.128 167.68 82.04C168.448 80.952 168.832 79.704 168.832 78.296C168.832 76.696 168.448 75.288 167.68 74.072C166.912 72.792 165.568 71.608 163.648 70.52L149.248 61.688C145.728 59.512 143.104 57.048 141.376 54.296C139.648 51.48 138.784 48.344 138.784 44.888C138.784 41.432 139.616 38.328 141.28 35.576C143.008 32.76 145.376 30.52 148.384 28.856C151.392 27.192 154.816 26.36 158.656 26.36C162.816 26.36 166.496 27.16 169.696 28.76C172.896 30.296 175.776 32.344 178.336 34.904L170.752 43.16C168.832 41.304 166.88 39.864 164.896 38.84C162.912 37.752 160.768 37.208 158.464 37.208C156.928 37.208 155.552 37.528 154.336 38.168C153.184 38.808 152.288 39.64 151.648 40.664C151.008 41.688 150.688 42.84 150.688 44.12C150.688 45.72 151.072 47.128 151.84 48.344C152.608 49.56 153.92 50.776 155.776 51.992L170.272 60.728C173.856 62.904 176.48 65.4 178.144 68.216C179.872 71.032 180.736 74.136 180.736 77.528C180.736 81.176 179.84 84.44 178.048 87.32C176.32 90.136 173.856 92.376 170.656 94.04C167.52 95.64 163.872 96.44 159.712 96.44ZM231.547 95H187.771V27.8H231.547V38.648H199.771V55.16H223.195V65.816H199.771V84.152H231.547V95ZM270.213 96.44C265.285 96.44 260.677 95.544 256.389 93.752C252.101 91.896 248.325 89.368 245.061 86.168C241.861 82.968 239.333 79.256 237.477 75.032C235.685 70.744 234.789 66.2 234.789 61.4C234.789 56.6 235.685 52.088 237.477 47.864C239.333 43.576 241.861 39.832 245.061 36.632C248.325 33.432 252.101 30.936 256.389 29.144C260.677 27.288 265.285 26.36 270.213 26.36C275.141 26.36 279.749 27.288 284.037 29.144C288.389 30.936 292.165 33.432 295.365 36.632C298.629 39.832 301.157 43.576 302.949 47.864C304.805 52.088 305.733 56.6 305.733 61.4C305.733 66.2 304.805 70.744 302.949 75.032C301.157 79.256 298.629 82.968 295.365 86.168C292.165 89.368 288.389 91.896 284.037 93.752C279.749 95.544 275.141 96.44 270.213 96.44ZM270.213 85.304C273.477 85.304 276.517 84.728 279.333 83.576C282.149 82.36 284.613 80.664 286.725 78.488C288.901 76.312 290.565 73.784 291.717 70.904C292.933 67.96 293.541 64.792 293.541 61.4C293.541 58.008 292.933 54.872 291.717 51.992C290.565 49.048 288.901 46.488 286.725 44.312C284.613 42.136 282.149 40.472 279.333 39.32C276.517 38.104 273.477 37.496 270.213 37.496C267.013 37.496 264.005 38.104 261.189 39.32C258.373 40.472 255.877 42.136 253.701 44.312C251.589 46.488 249.925 49.048 248.709 51.992C247.557 54.872 246.981 58.008 246.981 61.4C246.981 64.792 247.557 67.96 248.709 70.904C249.925 73.784 251.589 76.312 253.701 78.488C255.813 80.664 258.277 82.36 261.093 83.576C263.973 84.728 267.013 85.304 270.213 85.304Z" class="text-primary" fill="currentColor"></path><path d="M334.493 57.848H326.717V47.672H334.493V33.56H346.301V47.672H356.573V57.848H346.301V80.6C346.301 81.944 346.685 83.032 347.453 83.864C348.285 84.696 349.405 85.112 350.813 85.112C351.709 85.112 352.477 85.016 353.117 84.824C353.821 84.568 354.461 84.216 355.037 83.768L358.397 93.08C357.117 93.784 355.709 94.36 354.173 94.808C352.701 95.256 351.037 95.48 349.181 95.48C344.637 95.48 341.053 94.232 338.429 91.736C335.805 89.176 334.493 85.624 334.493 81.08V57.848ZM385.851 96.248C380.987 96.248 376.603 95.16 372.699 92.984C368.859 90.744 365.787 87.736 363.483 83.96C361.243 80.184 360.123 75.992 360.123 71.384C360.123 66.712 361.243 62.488 363.483 58.712C365.787 54.936 368.859 51.96 372.699 49.784C376.603 47.544 380.987 46.424 385.851 46.424C390.651 46.424 395.003 47.544 398.907 49.784C402.811 51.96 405.883 54.936 408.123 58.712C410.427 62.488 411.579 66.68 411.579 71.288C411.579 75.96 410.427 80.184 408.123 83.96C405.883 87.736 402.811 90.744 398.907 92.984C395.003 95.16 390.651 96.248 385.851 96.248ZM385.755 85.88C388.507 85.88 390.939 85.24 393.051 83.96C395.227 82.68 396.923 80.952 398.139 78.776C399.355 76.536 399.963 74.04 399.963 71.288C399.963 68.536 399.355 66.072 398.139 63.896C396.923 61.72 395.227 59.992 393.051 58.712C390.939 57.432 388.507 56.792 385.755 56.792C383.131 56.792 380.731 57.432 378.555 58.712C376.443 59.992 374.747 61.72 373.467 63.896C372.251 66.072 371.643 68.568 371.643 71.384C371.643 74.136 372.251 76.6 373.467 78.776C374.747 80.952 376.443 82.68 378.555 83.96C380.731 85.24 383.131 85.88 385.755 85.88ZM442.383 96.248C437.519 96.248 433.135 95.16 429.231 92.984C425.391 90.744 422.319 87.736 420.015 83.96C417.775 80.184 416.655 75.992 416.655 71.384C416.655 66.712 417.775 62.488 420.015 58.712C422.319 54.936 425.391 51.96 429.231 49.784C433.135 47.544 437.519 46.424 442.383 46.424C447.183 46.424 451.535 47.544 455.439 49.784C459.343 51.96 462.415 54.936 464.655 58.712C466.959 62.488 468.111 66.68 468.111 71.288C468.111 75.96 466.959 80.184 464.655 83.96C462.415 87.736 459.343 90.744 455.439 92.984C451.535 95.16 447.183 96.248 442.383 96.248ZM442.286 85.88C445.039 85.88 447.471 85.24 449.583 83.96C451.759 82.68 453.455 80.952 454.671 78.776C455.887 76.536 456.495 74.04 456.495 71.288C456.495 68.536 455.887 66.072 454.671 63.896C453.455 61.72 451.759 59.992 449.583 58.712C447.471 57.432 445.039 56.792 442.286 56.792C439.663 56.792 437.263 57.432 435.087 58.712C432.975 59.992 431.279 61.72 429.999 63.896C428.783 66.072 428.174 68.568 428.174 71.384C428.174 74.136 428.783 76.6 429.999 78.776C431.279 80.952 432.975 82.68 435.087 83.96C437.263 85.24 439.663 85.88 442.286 85.88ZM487.01 95H475.202V24.44H487.01V95ZM507.53 95H495.722V24.44H507.53V95ZM539.978 47.672L520.202 66.776L517.61 68.216L500.426 85.496L506.378 66.776L525.482 47.672H539.978ZM541.226 95H528.362L510.026 64.184L521.93 64.088L541.226 95ZM557.226 95H545.418V47.672H557.226V95ZM544.17 34.712C544.17 33.368 544.458 32.152 545.034 31.064C545.674 29.976 546.538 29.112 547.626 28.472C548.714 27.832 549.962 27.512 551.37 27.512C552.714 27.512 553.93 27.832 555.018 28.472C556.106 29.112 556.938 29.976 557.514 31.064C558.154 32.152 558.474 33.336 558.474 34.616C558.474 35.96 558.154 37.176 557.514 38.264C556.938 39.352 556.106 40.216 555.018 40.856C553.93 41.496 552.714 41.816 551.37 41.816C550.026 41.816 548.778 41.496 547.626 40.856C546.538 40.216 545.674 39.384 545.034 38.36C544.458 37.272 544.17 36.056 544.17 34.712ZM570.743 57.848H562.967V47.672H570.743V33.56H582.551V47.672H592.823V57.848H582.551V80.6C582.551 81.944 582.935 83.032 583.703 83.864C584.535 84.696 585.655 85.112 587.063 85.112C587.959 85.112 588.727 85.016 589.367 84.824C590.071 84.568 590.711 84.216 591.287 83.768L594.647 93.08C593.367 93.784 591.959 94.36 590.423 94.808C588.951 95.256 587.287 95.48 585.431 95.48C580.887 95.48 577.303 94.232 574.679 91.736C572.055 89.176 570.743 85.624 570.743 81.08V57.848Z" class="text-white" fill="currentColor"></path><g clip-path="url(#clip0_5_22)"><path fill-rule="evenodd" clip-rule="evenodd" d="M83.008 86.008C85.686 83.331 90.028 83.331 92.706 86.008L110.992 104.294C113.669 106.972 113.669 111.314 110.992 113.992C108.314 116.669 103.972 116.669 101.294 113.992L83.008 95.706C80.331 93.028 80.331 88.686 83.008 86.008Z" class="text-primary" fill="currentColor"></path><path d="M46 89C68.0914 89 86 71.0914 86 49C86 26.9086 68.0914 9 46 9C23.9086 9 6 26.9086 6 49C6 71.0914 23.9086 89 46 89Z" class="text-primary" fill="currentColor" fill-opacity="0.5" stroke="currentColor" stroke-width="12" stroke-linecap="round"></path></g><defs><clipPath id="clip0_5_22"><rect width="113" height="113" fill="white" transform="translate(0 3)"></rect></clipPath></defs></svg>`);
}
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Global/AppLogoWhite.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const AppLogoWhite = /* @__PURE__ */ _export_sfc(_sfc_main$3, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main$2 = {
  __name: "NavBar",
  __ssrInlineRender: true,
  setup(__props) {
    const navLinks = [
      {
        url: route("home"),
        name: "Home",
        disabled: false
      },
      {
        url: route("opengraph"),
        name: "Open Graph",
        disabled: false
      },
      {
        url: route("lighthouse"),
        name: "Lighthouse",
        disabled: false
      },
      {
        url: "",
        name: "PWA Tester",
        disabled: true
      },
      {
        url: "",
        name: "DNS Tester",
        disabled: true
      }
    ];
    const navOpen = ref(false);
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<nav${ssrRenderAttrs(mergeProps({ class: "bg-transparent border-gray-200 px-4 py-2.5 rounded font-body-settings" }, _attrs))}><div class="container flex flex-wrap items-center justify-between mx-auto"><a${ssrRenderAttr("href", _ctx.route("home"))} class="flex items-center">`);
      _push(ssrRenderComponent(AppLogo, { class: "w-48 mr-3 flex dark:hidden" }, null, _parent));
      _push(ssrRenderComponent(AppLogoWhite, { class: "w-48 mr-3 hidden dark:flex" }, null, _parent));
      _push(`</a><button type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-secondary dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false"><span class="sr-only">Open main menu</span><svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg></button><div class="${ssrRenderClass([!navOpen.value ? "hidden" : "", "w-full md:block md:w-auto"])}" id="navbar-default"><ul class="flex flex-col px-4 md:px-8 pb-8 md:pb-4 pt-4 mt-4 border border-gray-100 space-y-4 md:space-y-0 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white shadow-sm dark:bg-gray-900 md:dark:bg-gray-900 dark:border-secondary"><!--[-->`);
      ssrRenderList(navLinks, (link) => {
        _push(`<li>`);
        _push(ssrRenderComponent(unref(Link), {
          href: link.url,
          class: ["block py-2 pl-3 pr-4 text-secondary transition-all rounded md:bg-transparent dark:md:text-white md:p-0", [
            unref(usePage)().props.currentUrl === link.url ? "md:text-primary bg-primary text-white" : "md:text-secondary  md:hover:text-primary",
            link.disabled ? "pointer-events-none relative" : ""
          ]]
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(`${ssrInterpolate(link.name)} `);
              if (link.disabled) {
                _push2(`<span class="absolute top-8 md:top-4 left-2.5 md:left-0 text-xs"${_scopeId}> Coming soon </span>`);
              } else {
                _push2(`<!---->`);
              }
            } else {
              return [
                createTextVNode(toDisplayString(link.name) + " ", 1),
                link.disabled ? (openBlock(), createBlock("span", {
                  key: 0,
                  class: "absolute top-8 md:top-4 left-2.5 md:left-0 text-xs"
                }, " Coming soon ")) : createCommentVNode("", true)
              ];
            }
          }),
          _: 2
        }, _parent));
        _push(`</li>`);
      });
      _push(`<!--]--></ul></div></div></nav>`);
    };
  }
};
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Global/NavBar.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const WaveHeader_vue_vue_type_style_index_0_scoped_e4379be4_lang = "";
const _sfc_main$1 = {};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs) {
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "wave-container" }, _attrs))} data-v-e4379be4><div class="wave" data-v-e4379be4></div><div class="wave" data-v-e4379be4></div><div class="wave" data-v-e4379be4></div></div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Global/WaveHeader.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const WaveHeader = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender], ["__scopeId", "data-v-e4379be4"]]);
const _sfc_main = {
  __name: "Layout",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<main${ssrRenderAttrs(_attrs)}>`);
      _push(ssrRenderComponent(_sfc_main$5, null, null, _parent));
      _push(`<article>`);
      _push(ssrRenderComponent(WaveHeader, null, null, _parent));
      _push(ssrRenderComponent(_sfc_main$2, null, null, _parent));
      _push(`<div class="mt-8 md:mt-40">`);
      ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
      _push(`</div></article></main>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/Layout.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
createServer(
  (page) => createInertiaApp({
    title: (title) => `${title} - ${"SEO Toolkit"}`,
    render: renderToString,
    resolve: (name) => {
      const pages = /* @__PURE__ */ Object.assign({ "./Pages/Home.vue": __vite_glob_0_0, "./Pages/Lighthouse.vue": __vite_glob_0_1, "./Pages/OpenGraph.vue": __vite_glob_0_2 });
      let page2 = pages[`./Pages/${name}.vue`];
      page2.default.layout = page2.default.layout || _sfc_main;
      return page2;
    },
    setup({ el, App, props, plugin }) {
      const Vue = createSSRApp({
        render: () => h(App, props)
      });
      Vue.use(plugin);
      Vue.config.globalProperties.route = window.route;
      Vue.mount(el);
    }
  }),
  8080
);
