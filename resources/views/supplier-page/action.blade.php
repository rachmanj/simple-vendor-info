{{-- destroy button with alert confirmation --}}
<form action="{{ route('supplier-page.destroy', $model->id) }}" method="POST" class="d-inline">
    @csrf @method('DELETE')
    {{-- show --}}
    <a href="{{ route('supplier-page.show', $model->id) }}" class="btn btn-xs btn-info">show</a>
    {{-- add / edit documents --}}
    @can('akses_legalitas')
    <a href="{{ route('supplier-page.legalitas', $model->id) }}" class="btn btn-xs btn-primary">add/edit docs</a>
    @endcan
    {{-- edit --}}
    @can('edit_vendor')
    <a href="{{ route('supplier-page.edit', $model->id) }}" class="btn btn-xs btn-warning"> edit</a>
    @endcan
    {{-- delete --}}
    @can('delete_vendor')
    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want delete this record? This action will delete all records connected to vendor including documents and contacts')">delete</button>
    @endcan
</form>
