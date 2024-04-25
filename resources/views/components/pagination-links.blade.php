@props(['model'])

<div class="mt-5">
    {{ $model->appends(request()->query())->links() }}
</div>    