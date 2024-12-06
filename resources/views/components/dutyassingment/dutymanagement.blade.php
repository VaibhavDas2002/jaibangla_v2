<x-app-layout>
    <x-slot name="title">
        <h1>Duty Management</h1>
    </x-slot>

    <x-slot name="content">
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-8"></div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div id="scheme_workflow" class="panel-collapse collapse show">
                                <div class="panel-body" id="level_map">
                                    <div id="example2_wrapper" class="col-md-12 dataTables_wrapper form-inline dt-bootstrap js-report-form">
                                        <!-- Add Button -->
                                        <div class="col-md-12" id="addButton">
                                            <form class="form-horizontal" role="form" method="GET" action="{{ route('dutymanagementForm') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <div class="col-md-8 d-flex align-items-center justify-content-start">
                                                        <x-button.success type="submit">
                                                            Add User and Assign Role
                                                        </x-button.success>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Include the Livewire component for the table -->
                                        <livewire:duty-management-table />

                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
