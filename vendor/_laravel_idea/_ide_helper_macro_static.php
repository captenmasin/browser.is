<?php //e0741237c89b13c3e986ea26598a8f93
/** @noinspection all */

namespace Illuminate\Database\Eloquent {

    use Illuminate\Support\HigherOrderTapProxy;

    /**
     * @method static $this onlyTrashed()
     * @method static int restore()
     * @method static $this|Model|HigherOrderTapProxy|mixed restoreOrCreate(array $attributes = [], array $values = [])
     * @method static $this withTrashed($withTrashed = true)
     * @method static $this withoutTrashed()
     */
    class Builder {}
}

namespace Illuminate\Foundation\Testing {

    /**
     * @method static $this assertInertia(\Closure $callback = null)
     * @method static array inertiaPage()
     */
    class TestResponse {}
}

namespace Illuminate\Http {

    /**
     * @method static bool hasValidRelativeSignature()
     * @method static bool hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
     * @method static bool inertia()
     */
    class Request {}
}

namespace Illuminate\Routing {

    /**
     * @method static void inertia($uri, $component, $props = [])
     */
    class Router {}
}

namespace Illuminate\Testing {

    /**
     * @method static $this assertInertia(\Closure $callback = null)
     * @method static array inertiaPage()
     */
    class TestResponse {}
}

namespace Inertia {

    /**
     * @method static void withMeta($meta)
     */
    class Response {}
}
