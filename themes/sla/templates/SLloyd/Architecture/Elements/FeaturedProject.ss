<% with $FeaturedProject %>
<div class="element-featured-project d-flex">

    <div class="element-featured-project--image">
        <a class="element-featured-project--image__link image-link" href="$Link">
            <% with $FeaturedImage %>
                <img class="element-featured-project--image__image"
                     srcset="$FocusFill(800, 800).URL,
                        $FocusFill(1000, 1000).URL 1.5x,
                        $FocusFill(1600, 1600).URL 2x"
                     src="$FocusFill(1600, 1600).URL" alt="$Title">
            <% end_with %>
        </a>
    </div>
    <div class="element-featured-project--details content-container">

        <h2 class="featured">
            <a href="$Link">$Title</a>
        </h2>
        <div class="details">
            <p class="lead">
                $ShortDescription
            </p>
            <a class="button featured" href="$Link">View Project</a>
        </div>

    </div>

</div>
<% end_with %>
