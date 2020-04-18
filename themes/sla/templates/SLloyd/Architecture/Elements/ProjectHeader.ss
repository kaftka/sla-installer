<div class="banner-element background-{$BackgroundColor.Lowercase}
            d-flex
            <% if $InvertBackground %> invert<% end_if %>
            Full-height"
    >
    <div class="flex-container">
        <div class="flex-child size1.5<% if $ImagePosition == 'Right' %> order-2<% end_if %> content-container">
            <% if $Image %>
                <% with $Image %>
                    <a class="image-link lightbox" href="$Link" data-caption="<% if $Caption %>$Caption<% else %>$Title<% end_if %>">
                        <figure>
                            <img class="element-featured-project--image__image"
                                 srcset="$FocusFill(900, 1200).URL,
                                $FocusFill(1350, 1800).URL 1.5x,
                                $FocusFill(1800, 2400).URL 2x"
                                 src="$FocusFill(1800, 2400).URL" alt="$Title">
                            <% if $Caption %>
                                <figcaption>$Caption</figcaption>
                            <% end_if %>
                        </figure>
                        <% end_with %>
                    </a>
            <% end_if %>
        </div>
        <div class="flex-child content-container">
            <% if $Title && $ShowTitle %>
                <h2>
                    $Title
                </h2>
            <% end_if %>
            <div class="details">
                <p class="lead">
                    $Content
                </p>
            </div>
        </div>
    </div>


</div>
