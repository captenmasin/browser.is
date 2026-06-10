import {usePage} from "@inertiajs/vue3";

export function useEnum(name = "", key: string | number = "") {
	return usePage().props.enums[name][key];
}
