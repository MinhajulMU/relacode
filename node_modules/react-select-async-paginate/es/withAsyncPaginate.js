import _objectSpread from "@babel/runtime/helpers/objectSpread2";
import { jsx as _jsx } from "react/jsx-runtime";
import _objectWithoutProperties from "@babel/runtime/helpers/objectWithoutProperties";
import { useAsyncPaginate } from './useAsyncPaginate';
import { useComponents } from './useComponents';
export function withAsyncPaginate( // eslint-disable-next-line @typescript-eslint/naming-convention
SelectComponent) {
  var WithAsyncPaginate = function WithAsyncPaginate(props) {
    var components = props.components,
        selectRef = props.selectRef,
        useComponentsProp = props.useComponents,
        useAsyncPaginateProp = props.useAsyncPaginate,
        cacheUniqs = props.cacheUniqs,
        rest = _objectWithoutProperties(props, ["components", "selectRef", "useComponents", "useAsyncPaginate", "cacheUniqs"]);

    var asyncPaginateProps = useAsyncPaginateProp(rest, cacheUniqs);
    var processedComponents = useComponentsProp(components);
    return /*#__PURE__*/_jsx(SelectComponent, _objectSpread(_objectSpread(_objectSpread({}, props), asyncPaginateProps), {}, {
      components: processedComponents,
      ref: selectRef
    }));
  };

  WithAsyncPaginate.defaultProps = {
    selectRef: null,
    cacheUniqs: [],
    components: {},
    useComponents: useComponents,
    useAsyncPaginate: useAsyncPaginate
  };
  return WithAsyncPaginate;
}