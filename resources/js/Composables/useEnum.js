import {usePage} from "@inertiajs/vue3";

export function useEnum(name = "", key = {}) {
	return usePage().props.enums[name][key];
}
