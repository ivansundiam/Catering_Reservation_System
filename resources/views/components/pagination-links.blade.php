@props(['model'])

<div class="mt-5">
    {{ $model->onEachSide(1)->links() }}
</div>    