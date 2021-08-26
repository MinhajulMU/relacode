import { useMemo } from 'react';
import type { SelectComponentsConfig } from 'react-select';
export declare const MenuList: import("react").FC<import("./wrapMenuList").Props>;
export declare const useComponentsPure: <OptionType, IsMulti extends boolean>(useMemoParam: typeof useMemo, components: Partial<import("react-select/src/components").SelectComponents<OptionType, IsMulti>>) => Partial<import("react-select/src/components").SelectComponents<OptionType, IsMulti>>;
export declare const useComponents: <OptionType, IsMulti extends boolean>(components: Partial<import("react-select/src/components").SelectComponents<OptionType, IsMulti>>) => Partial<import("react-select/src/components").SelectComponents<OptionType, IsMulti>>;
