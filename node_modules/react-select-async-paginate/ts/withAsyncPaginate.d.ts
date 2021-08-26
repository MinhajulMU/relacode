import type { FC, ComponentType } from 'react';
import type { Props as SelectProps } from 'react-select';
import { useAsyncPaginate } from './useAsyncPaginate';
import { useComponents } from './useComponents';
import type { UseAsyncPaginateParams, ComponentProps } from './types';
export declare type Props<OptionType, Additional, IsMulti extends boolean> = SelectProps<OptionType, IsMulti> & UseAsyncPaginateParams<OptionType, Additional> & ComponentProps & {
    useComponents?: typeof useComponents;
    useAsyncPaginate?: typeof useAsyncPaginate;
};
export declare function withAsyncPaginate<OptionType, Additional, IsMulti extends boolean>(SelectComponent: ComponentType<SelectProps<OptionType, IsMulti>>): FC<Props<OptionType, Additional, IsMulti>>;
