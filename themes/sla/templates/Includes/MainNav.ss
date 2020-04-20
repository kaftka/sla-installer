
<nav id="MainNav" class="main-nav">

    <div class="site-brand">

        <a title="<%t BRANDNAV.Title "Go to Home Page" %>" class="site-brand--link" href="$BaseHref">
            <% if $SiteConfig.SiteLogo %>
                <img
                    src="$SiteConfig.SiteLogo.URL" width="$SiteConfig.SiteLogo.Width" height="$SiteConfig.SiteLogo.Height"
                    alt="$SiteConfig.Title"
                    aria-hidden="true" />
            <% end_if %>
            <span<% if $SiteConfig.SiteLogo %> class="sr-only"<% end_if %>>$SiteConfig.Title</span>
        </a>
    </div>

    <div class="menu">
        <ul class="main-menu">
            <% loop $Menu(1) %>
                <li class="main-menu--item">
                    <a class="main-menu--item__link" href="$Link" data-first-letter="$MenuTitle.LimitCharacters(1,'')">
                        $MenuTitle.XML
                    </a>
                </li>
            <% end_loop %>
        </ul>
    </div>
</nav>
