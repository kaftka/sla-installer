<% require css('silverstripe/blog: client/dist/styles/main.css') %>

<article>
<div class="blog-entry content-container">
        <h1>$Title</h1>

</div>

    <% if $FeaturedImage %>
        <p class="post-image">$FeaturedImage.ScaleWidth(795)</p>
    <% end_if %>

    $ElementalArea

    <% include SilverStripe\\Blog\\EntryMeta %>
</article>

$Form
$CommentsForm
