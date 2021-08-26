import { useState, useEffect, useRef, useCallback } from 'react';
import sleep from 'sleep-promise';
import useIsMounted from 'react-is-mounted-hook';
import type { OptionsCache, OptionsCacheItem, UseAsyncPaginateBaseResult, UseAsyncPaginateBaseParams, ReduceOptions } from './types';
export declare const validateResponse: (console: Console, response: any) => void;
export declare const getInitialOptionsCache: <OptionType, Additional>({ options, defaultOptions, additional, defaultAdditional, }: UseAsyncPaginateBaseParams<OptionType, Additional>) => OptionsCache<OptionType, Additional>;
export declare const getInitialCache: <OptionType, Additional>(params: UseAsyncPaginateBaseParams<OptionType, Additional>) => OptionsCacheItem<OptionType, Additional>;
declare type MapOptionsCache<OptionType, Additional> = (prevCache: OptionsCache<OptionType, Additional>) => OptionsCache<OptionType, Additional>;
declare type SetOptionsCache<OptionType, Additional> = (stateMapper: MapOptionsCache<OptionType, Additional>) => void;
export declare const requestOptions: <OptionType, Additional>(paramsRef: {
    current: UseAsyncPaginateBaseParams<OptionType, Additional>;
}, optionsCacheRef: {
    current: OptionsCache<OptionType, Additional>;
}, debounceTimeout: number, sleepParam: typeof sleep, setOptionsCache: SetOptionsCache<OptionType, Additional>, validateResponseParam: typeof validateResponse, reduceOptions: ReduceOptions<OptionType, Additional>) => Promise<void>;
export declare const increaseStateId: (prevStateId: number) => number;
export declare const useAsyncPaginateBasePure: <OptionType, Additional>(useRefParam: typeof useRef, useStateParam: typeof useState, useEffectParam: typeof useEffect, useCallbackParam: typeof useCallback, useIsMountedParam: typeof useIsMounted, validateResponseParam: typeof validateResponse, getInitialOptionsCacheParam: typeof getInitialOptionsCache, requestOptionsParam: typeof requestOptions, params: UseAsyncPaginateBaseParams<OptionType, Additional>, deps?: ReadonlyArray<any>) => UseAsyncPaginateBaseResult<OptionType>;
export declare const useAsyncPaginateBase: <OptionType, Additional>(params: UseAsyncPaginateBaseParams<OptionType, Additional>, deps?: ReadonlyArray<any>) => UseAsyncPaginateBaseResult<OptionType>;
export {};
