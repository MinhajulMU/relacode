import _objectSpread from "@babel/runtime/helpers/objectSpread2";
import { jsx as _jsx } from "react/jsx-runtime";
import { useEffect, useRef, useCallback } from 'react';
import composeRefs from '@seznam/compose-react-refs';
export var CHECK_TIMEOUT = 300;
// eslint-disable-next-line @typescript-eslint/naming-convention
export var wrapMenuList = function wrapMenuList(MenuList) {
  var WrappedMenuList = function WrappedMenuList(props) {
    var _props$selectProps = props.selectProps,
        handleScrolledToBottom = _props$selectProps.handleScrolledToBottom,
        shouldLoadMore = _props$selectProps.shouldLoadMore,
        innerRef = props.innerRef,
        useEffectProp = props.useEffect,
        useRefProp = props.useRef,
        useCallbackProp = props.useCallback,
        setTimeoutProp = props.setTimeout,
        clearTimeoutProp = props.clearTimeout;
    var checkTimeoutRef = useRefProp(null);
    var menuListRef = useRefProp(null);
    var shouldHandle = useCallbackProp(function () {
      var el = menuListRef.current; // menu not rendered

      if (!el) {
        return false;
      }

      var scrollTop = el.scrollTop,
          scrollHeight = el.scrollHeight,
          clientHeight = el.clientHeight;
      return shouldLoadMore(scrollHeight, clientHeight, scrollTop);
    }, [shouldLoadMore]);
    var checkAndHandle = useCallbackProp(function () {
      if (shouldHandle()) {
        if (handleScrolledToBottom) {
          handleScrolledToBottom();
        }
      }
    }, [shouldHandle, handleScrolledToBottom]);
    var setCheckAndHandleTimeout = useCallbackProp(function () {
      checkAndHandle();
      checkTimeoutRef.current = setTimeoutProp(setCheckAndHandleTimeout, CHECK_TIMEOUT);
    }, [checkAndHandle]);
    useEffectProp(function () {
      setCheckAndHandleTimeout();
      return function () {
        if (checkTimeoutRef.current) {
          clearTimeoutProp(checkTimeoutRef.current);
        }
      };
    }, []);
    return /*#__PURE__*/_jsx(MenuList, _objectSpread(_objectSpread({}, props), {}, {
      innerRef: composeRefs(innerRef, menuListRef)
    }));
  };

  WrappedMenuList.defaultProps = {
    useEffect: useEffect,
    useRef: useRef,
    useCallback: useCallback,
    setTimeout: setTimeout,
    clearTimeout: clearTimeout
  };
  return WrappedMenuList;
};