<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="count">Total: @php echo getCount(); @endphp</div>
        <div class="mb-3 text-right">
                            <button type="button" data-toggle="modal" data-target="#url-add-modal" class="btn tab-btn add-button">Add</button>
                        </div>
                        <br>
                        <table id="url" class="display compact nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titile</th>
                                <th>Url</th>
                                <th>Slug</th>
                                <th>Created Date</th>
                                
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>

        </div>
    </div>

    <div id="url-add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Add url</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  action="#" name="url-add-form" id="url-add-form" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="title" class="control-label">Title<sup class="mandatory">*</sup></label>
                                <input type="text" class="form-control" name="title" id="title" />
                                <div class="help-block with-errors">
                                    <span class="help-block" id="title-error"><strong><p></p></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="url" class="control-label">URL<sup class="mandatory">*</sup></label>
                                <input type="text" class="form-control" name="url" id="url" />
                                <div class="help-block with-errors">
                                    <span class="help-block" id="url-error"><strong><p></p></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="add btn btn-success store">Save</button>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
