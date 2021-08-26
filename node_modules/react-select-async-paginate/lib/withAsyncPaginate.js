"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.withAsyncPaginate = withAsyncPaginate;

var _objectSpread2 = _interopRequireDefault(require("@babel/runtime/helpers/objectSpread2"));

var _jsxRuntime = require("react/jsx-runtime");

var _objectWithoutProperties2 = _interopRequireDefault(require("@babel/runtime/helpers/objectWithoutProperties"));

var _useAsyncPaginate = require("./useAsyncPaginate");

var _useComponents = require("./useComponents");

function withAsyncPaginate( // eslint-disable-next-line @typescript-eslint/naming-convention
SelectComponent) {
  var WithAsyncPaginate = function WithAsyncPaginate(props) {
    var components = props.components,
        selectRef = props.selectRef,
        useComponentsProp = props.useComponents,
        useAsyncPaginateProp = props.useAsyncPaginate,
        cacheUniqs = props.cacheUniqs,
        rest = (0, _objectWithoutProperties2["default"])(props, ["components", "selectRef", "useComponents", "useAsyncPaginate", "cacheUniqs"]);
    var asyncPaginateProps = useAsyncPaginateProp(rest, cacheUniqs);
    var processedComponents = useComponentsProp(components);
    return /*#__PURE__*/(0, _jsxRuntime.jsx)(SelectComponent, (0, _objectSpread2["default"])((0, _objectSpread2["default"])((0, _objectSpread2["default"])({}, props), asyncPaginateProps), {}, {
      components: processedComponents,
      ref: selectRef
    }));
  };

  WithAsyncPaginate.defaultProps = {
    selectRef: null,
    cacheUniqs: [],
    components: {},
    useComponents: _useComponents.useComponents,
    useAsyncPaginate: _useAsyncPaginate.useAsyncPaginate
  };
  return WithAsyncPaginate;
}