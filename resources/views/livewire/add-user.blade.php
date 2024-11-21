<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New User and Assign Role
                    <a href=""><img style="float:left" width="40" height="40" src="{{ asset('/images/back.png') }}"/></a>
                </div>
                <div class="panel-body">

                    <!-- Success message -->
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif

                    <!-- Error messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form wire:submit.prevent="submit" class="form-horizontal">
                        <div class="form-group">
                            <label for="fullname" class="col-md-4 control-label required-field">Full Name</label>
                            <div class="col-md-6">
                                <input id="fullname" name="fullname" type="text" class="form-control" wire:model="fullname" autocomplete="off" maxlength="60">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label required-field">Display Name</label>
                            <div class="col-md-6">
                                <input id="username" name="username" type="text" class="form-control" wire:model="username" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label required-field">Email</label>
                            <div class="col-md-6">
                                <input id="email" name="email" type="email" class="form-control" wire:model="email" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-md-4 control-label required-field">Mobile No.</label>
                            <div class="col-md-6">
                                <input id="mobile" name="mobile_no" type="text" class="form-control" wire:model="mobile" maxlength="10" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label required-field">Password</label>
                            <div class="col-md-6">
                                <input id="password" name="password" type="password" class="form-control" wire:model="password" autocomplete="off">
                            </div>
                        </div>

                        <!-- User Level Dropdown -->
                        <div class="form-group">
                            <label for="user_level" class="col-md-4 control-label required-field">User Level</label>
                            <div class="col-md-6">
                                <select class="form-control" wire:model.live="user_level_id">
                                    <option value="">--Select User Level--</option>
                                    @foreach($userLevels as $level)
                                        <option value="{{ $level->id }}">{{ $level->stake_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- District Dropdown (conditional) -->
                        @if($districts && count($districts) > 0)
                            <div class="form-group">
                                <label for="district" class="col-md-4 control-label required-field">Select District</label>
                                <div class="col-md-6">
                                    <select class="form-control" wire:model.live="district_id">
                                        <option value="">--Select District--</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <!-- Block Dropdown (conditional based on district and user level) -->
                        @if($blocks && $this->shouldShowBlocks)
                        <div class="form-group">
                                <label for="block" class="col-md-4 control-label required-field">Select Block</label>
                                <div class="col-md-6">
                                    <select class="form-control" wire:model="block_id">
                                        <option value="">--Select Block--</option>
                                        @foreach($blocks as $block)
                                            <option value="{{ $block->id }}">{{ $block->block_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <!-- Subdiv drop down -->
                        @if($subdivisions && $this->shouldShowSubdivisions)
                        <div class="form-group">
                            <label for="subdivision" class="col-md-4 control-label required-field">Select Subdivision</label>
                            <div class="col-md-6">
                                <select class="form-control" wire:model="subdivision_id">
                                    <option value="">--Select Subdivision--</option>
                                    @foreach($subdivisions as $subdivision)
                                        <option value="{{ $subdivision->id }}">{{ $subdivision->sub_district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif


                        <div class="form-group">
                            <label class="col-md-4 control-label required-field">Role</label>
                            <div class="col-md-6">
                                <select class="form-control role-select" id="role" name="role_id" wire:model="role_id">
                                    <option value="">--Select Role--</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Multi-select for Scheme without Select2 -->
                        <div class="form-group">
                            <label class="col-md-4 control-label required-field">Scheme</label>
                            <div class="col-md-6">
                                <select id="scheme" class="form-control custom-multiselect" wire:model="schemelist" multiple>
                                    <option value="">--Select Scheme--</option>
                                    @foreach ($schemes as $scheme)
                                    <option value="{{ $scheme->id }}">{{ $scheme->scheme_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- End of root container -->
