<?php //99a8d7d6212331c34ad543ca909445aa
/** @noinspection all */

namespace Illuminate\Database\Eloquent {

    use Illuminate\Support\HigherOrderTapProxy;

    /**
     * @method $this onlyTrashed()
     * @method int restore()
     * @method $this|Model|HigherOrderTapProxy|mixed restoreOrCreate(array $attributes = [], array $values = [])
     * @method $this withTrashed($withTrashed = true)
     * @method $this withoutTrashed()
     */
    class Builder {}
}

namespace Illuminate\Foundation\Testing {

    /**
     * @method $this assertInertia(\Closure $callback = null)
     * @method array inertiaPage()
     */
    class TestResponse {}
}

namespace Illuminate\Http {

    /**
     * @method bool hasValidRelativeSignature()
     * @method bool hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
     * @method bool inertia()
     */
    class Request {}
}

namespace Illuminate\Routing {

    /**
     * @method void inertia($uri, $component, $props = [])
     */
    class Router {}
}

namespace Illuminate\Testing {

    /**
     * @method $this assertInertia(\Closure $callback = null)
     * @method array inertiaPage()
     */
    class TestResponse {}
}

namespace Inertia {

    /**
     * @method void withMeta($meta)
     */
    class Response {}
}
