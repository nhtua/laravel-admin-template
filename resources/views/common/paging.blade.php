<div class="container">
    <div class="col-md-4 text-left">
        Show {{$data->count()."/".$data->total()}} results, from {{ NULL !== $data->firstItem() | $data->firstItem() }} to {{NULL !== $data->lastItem() | $data->lastItem()}}. 
    </div>
    <div class="col-md-8 text-right">
        {!! $data->links() !!}
    </div>
</div>
