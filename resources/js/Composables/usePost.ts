import {usePage} from "@inertiajs/vue3";
import {sameOriginUrl} from "@/Composables/useUrl";

type PostData = Record<string, unknown> & {
	_token?: string
}

export async function usePost(url = "", data: PostData = {}) {
	// Default options are marked with *
	data._token = usePage<AppPageProps>().props.csrf_token
	const response = await fetch(sameOriginUrl(url), {
		method: "POST", // *GET, POST, PUT, DELETE, etc.
		mode: "cors", // no-cors, *cors, same-origin
		cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
		credentials: "same-origin", // include, *same-origin, omit
		headers: {
			"Content-Type": "application/json",
			// 'Content-Type': 'application/x-www-form-urlencoded',
		},
		redirect: "follow", // manual, *follow, error
		referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
		body: JSON.stringify(data), // body data type must match "Content-Type" header
	});
	return response.json(); // parses JSON response into native JavaScript objects
}
