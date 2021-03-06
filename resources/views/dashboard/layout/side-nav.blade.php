<div class="side-nav" id="my-sidenav">
    <div class="side-nav-skin">
        <div class="side-nav-content blue-gray-darken-3">
            <div class="d-flex justify-content-center pt-2">
                <img src="{{asset("img/logo.png")}}" class="img-fluid" alt="Brand Logo">
            </div>
            <hr class="hr-light"/>
            <div class="accordion main-list" id="accordion-side-nav">
                <div class="list-item">
                    <div class="list-item-header collapsed" id="heading-vendors" data-toggle="collapse" data-target="#collapse-vendors" aria-expanded="false" aria-controls="collapse-vendors">
                        <div class="d-flex align-items-baseline">
                            <i class="fa fa-bars"></i>
                            <div class="px-2">
                                @lang("dashboard/layout.side-nav.block-vendors.header")
                            </div>
                        </div>
                    </div>
                    <div class="list-item-body collapse" id="collapse-vendors" aria-labelledby="heading-vendors" data-parent="#accordion-side-nav">
                        <div class="sup-list">
                            <a class="list-item" href="{{route("dashboard.vendors.create")}}">
                                @lang("dashboard/layout.side-nav.block-vendors.add")
                            </a>
                            <a class="list-item" href="{{route("dashboard.vendors.index")}}">
                                @lang("dashboard/layout.side-nav.block-vendors.all")
                            </a>
                        </div>
                    </div>
                </div>

                <div class="list-item">
                    <div class="list-item-header collapsed" id="heading-items" data-toggle="collapse" data-target="#collapse-items" aria-expanded="false" aria-controls="collapse-items">
                        <div class="d-flex align-items-baseline">
                            <i class="fa fa-bars"></i>
                            <div class="px-2">
                                @lang("dashboard/layout.side-nav.block-items.header")
                            </div>
                        </div>
                    </div>
                    <div class="list-item-body collapse" id="collapse-items" aria-labelledby="heading-items" data-parent="#accordion-side-nav">
                        <div class="sup-list">
                            <a class="list-item" href="{{ route("dashboard.items.create") }}">
                                @lang("dashboard/layout.side-nav.block-items.add")
                            </a>
                            <a class="list-item" href="{{ route("dashboard.items.index", ["f" => "all"]) }}">
                                @lang("dashboard/layout.side-nav.block-items.all")
                            </a>
                            <a class="list-item" href="{{ route("dashboard.items.index", ["f" => "deleted"]) }}">
                                @lang("dashboard/layout.side-nav.block-items.deleted")
                            </a>
                            <a class="list-item" href="{{ route("dashboard.classify-items.index") }}">
                                @lang("dashboard/layout.side-nav.block-items.classification")
                            </a>
                        </div>
                    </div>
                </div>

                <div class="list-item">
                    <div class="list-item-header collapsed" id="heading-categories" data-toggle="collapse" data-target="#collapse-categories" aria-expanded="false" aria-controls="collapse-categories">
                        <div class="d-flex align-items-baseline">
                            <i class="fa fa-sitemap"></i>
                            <div class="px-2">
                                @lang("dashboard/layout.side-nav.block-categories.header")
                            </div>
                        </div>
                    </div>
                    <div class="list-item-body collapse" id="collapse-categories" aria-labelledby="heading-categories" data-parent="#accordion-side-nav">
                        <div class="sup-list">
                            <a class="list-item" href="{{route("dashboard.categories.create")}}">
                                @lang("dashboard/layout.side-nav.block-categories.add")
                            </a>
                            <a class="list-item" href="{{route("dashboard.categories.index", ["filter" => "all"])}}">
                                @lang("dashboard/layout.side-nav.block-categories.all")
                            </a>
                            <a class="list-item" href="{{route("dashboard.main-show-category.index")}}">
                                @lang("dashboard/layout.side-nav.block-categories.main-show")
                            </a>
                        </div>
                    </div>
                </div>

                <div class="list-item">
                    <div class="list-item-header collapsed" id="heading-orders" data-toggle="collapse" data-target="#collapse-orders" aria-expanded="false" aria-controls="collapse-orders">
                        <div class="d-flex align-items-baseline">
                            <i class="fa fa-sitemap"></i>
                            <div class="px-2">
                                @lang("dashboard/layout.side-nav.block-orders.header")
                            </div>
                        </div>
                    </div>
                    <div class="list-item-body collapse" id="collapse-orders" aria-labelledby="heading-orders" data-parent="#accordion-side-nav">
                        <div class="sup-list">
                            <a class="list-item" href="{{route("dashboard.orders.index", ["filter" => "all"])}}">
                                @lang("dashboard/layout.side-nav.block-orders.all")
                            </a>
                            <a class="list-item" href="{{route("dashboard.orders.index", ["filter" => "review"])}}">
                                @lang("dashboard/layout.side-nav.block-orders.review")
                            </a>
                            <a class="list-item" href="{{route("dashboard.orders.index", ["filter" => "accept"])}}">
                                @lang("dashboard/layout.side-nav.block-orders.accept")
                            </a>
                            <a class="list-item" href="{{route("dashboard.orders.index", ["filter" => "reject"])}}">
                                @lang("dashboard/layout.side-nav.block-orders.reject")
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
