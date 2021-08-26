import { useState, useCallback } from 'react';
import type { UseAsyncPaginateParams, UseAsyncPaginateBaseParams, UseAsyncPaginateBaseResult, UseAsyncPaginateResult } from './types';
export declare const useAsyncPaginatePure: <OptionType, Additional>(useStateParam: typeof useState, useCallbackParam: typeof useCallback, useAsyncPaginateBaseParam: (params: UseAsyncPaginateBaseParams<OptionType, Additional>, deps: ReadonlyArray<any>) => UseAsyncPaginateBaseResult<OptionType>, params: UseAsyncPaginateParams<OptionType, Additional>, deps?: ReadonlyArray<any>) => UseAsyncPaginateResult<OptionType>;
export declare const useAsyncPaginate: <OptionType, Additional>(params: UseAsyncPaginateParams<OptionType, Additional>, deps?: ReadonlyArray<any>) => UseAsyncPaginateResult<OptionType>;
