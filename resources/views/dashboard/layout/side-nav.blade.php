<div class="side-nav" id="my-sidenav">
    <div class="side-nav-skin">
        <div class="side-nav-content blue-gray-darken-3">
            <div class="d-flex justify-content-center pt-2">
                <img src="{{asset("img/logo.png")}}" class="img-fluid" alt="Brand Logo">
            </div>
            <hr class="hr-light"/>
            <div class="accordion main-list" id="accordion-side-nav">
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
                            <a class="list-item" href="{{route("dashboard.items.index", ["f" => "all"])}}">
                                @lang("dashboard/layout.side-nav.block-items.all-items")
                            </a>
                            <a class="list-item" href="{{route("dashboard.items.index", ["f" => "categorized"])}}">
                                @lang("dashboard/layout.side-nav.block-items.categorized-items")
                            </a>
                            <a class="list-item" href="{{route("dashboard.items.index", ["f" => "un-categorized"])}}">
                                @lang("dashboard/layout.side-nav.block-items.un-categorized-items")
                            </a>
                            <a class="list-item" href="{{route("dashboard.items.index", ["f" => "deleted"])}}">
                                @lang("dashboard/layout.side-nav.block-items.deleted-items")
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
                            <a class="list-item" href="{{ route("dashboard.categories.index", ["f" => "all"]) }}">
                                @lang("dashboard/layout.side-nav.block-categories.all")
                            </a>
                            <a class="list-item" href="{{ route("dashboard.categories.index", ["f" => "main"]) }}">
                                @lang("dashboard/layout.side-nav.block-categories.main")
                            </a>
                            <a class="list-item" href="{{ route("dashboard.categories.index", ["f" => "sub"]) }}">
                                @lang("dashboard/layout.side-nav.block-categories.sub")
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
