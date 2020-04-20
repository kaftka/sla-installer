<% if $HTML || $Title %>
<div class="content-element__content content-container<% if $BreakContainer %> break-container<% end_if %><% if $Style %> $StyleVariant<% end_if %>">
    <div class="v-margin">
        <% if $ShowTitle %>
            <h2 class="content-element__title">$Title</h2>
        <% end_if %>
        $HTML
    </div>
</div>
<% end_if %>
