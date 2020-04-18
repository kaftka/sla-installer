<div class="banner-element background-{$BackgroundColor.Lowercase}
            d-flex
            <% if $InvertBackground %> invert<% end_if %>
            <% if $ImageType == 'Background' %> background-image {$ImagePosition}<% end_if %>
            $BannerSize"
            <% if $ImageType == 'Background' %>
                style="
                    background-image: url({$Image.ScaleWidth(1800).URL});
                    background-position: $FocusPos('X')% $FocusPos('Y')%;
                    background-size:cover"
            <% end_if %>
    >
    <div class="flex-container">
        <div class="flex-child<% if $ImageType == 'Inline' %> size1.5<% end_if %><% if $ImagePosition == 'Right' %> order-2<% end_if %> container">
            <% if $Image && $ImageType == 'Inline' %>
                <% with $Image %>
                    <a class="image-link lightbox" href="$Link" data-caption="<% if $Caption %>$Caption<% else %>$Title<% end_if %>">
                        <figure>
                            <% if $Top.BannerSize == 'Standard' %>
                            <img class="element-featured-project--image__image"
                                 srcset="$FocusFill(900, 400).URL,
                                    $FocusFill(1350, 600).URL 1.5x,
                                    $FocusFill(1800, 800).URL 2x"
                                 src="$FocusFill(1800, 800).URL" alt="$Title">
                            <% else %>
                                <img class="element-featured-project--image__image"
                                     srcset="$FocusFill(900, 1200).URL,
                                    $FocusFill(1350, 1800).URL 1.5x,
                                    $FocusFill(1800, 2400).URL 2x"
                                     src="$FocusFill(1800, 2400).URL" alt="$Title">
                            <% end_if %>
                            <% if $Caption %>
                                <figcaption>$Caption</figcaption>
                            <% end_if %>
                        </figure>
                        <% end_with %>
                    </a>
            <% end_if %>
        </div>
        <div class="flex-child container">
            <% if $Title && $ShowTitle %>
                <h2>
                    <% if $InternalLink || $ExternalLink %>
                        <a href="$Link">
                    <% end_if %>
                    $Title
                    <% if $InternalLink || $ExternalLink %>
                    </a>
                    <% end_if %>
                </h2>
            <% end_if %>
            <div class="details">
                <p class="lead">
                    $Content
                </p>
                <% if $InternalLink || $ExternalLink %>
                    <a class="button featured" href="$Link">$LinkTitle</a>
                <% end_if %>
            </div>
        </div>
    </div>


</div>
