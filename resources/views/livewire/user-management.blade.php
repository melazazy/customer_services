<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center form-bg-image">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">
                            {{ $userId ? 'Edit User' : 'Create a New User' }}
                        </h1>
                    </div>

                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="createOrUpdateUser">
                        <div class="form-group mb-4">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    wire:model="name"
                                    placeholder="Enter user's name"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    wire:model="email"
                                    placeholder="example@company.com"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone">Phone Number (Optional)</label>
                            <div class="input-group">
                                <input type="tel"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone"
                                    wire:model="phone"
                                    placeholder="Enter phone number">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if(!$userId)
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    wire:model="password"
                                    placeholder="Password"
                                    required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    wire:model="password_confirmation"
                                    placeholder="Confirm Password"
                                    required>
                            </div>
                        </div>
                        @endif


                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label for="country">Country (Optional)</label>
                                <input type="text"
                                    class="form-control @error('country') is-invalid @enderror"
                                    id="country"
                                    wire:model="country"
                                    placeholder="Enter country">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-4">
                                <label for="postal_code">Postal Code (Optional)</label>
                                <input type="text"
                                    class="form-control @error('postal_code') is-invalid @enderror"
                                    id="postal_code"
                                    wire:model="postal_code"
                                    placeholder="Enter postal code">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="role">User Role</label>
                            <div class="input-group">
                                <select
                                    class="form-control @error('role') is-invalid @enderror"
                                    id="role"
                                    wire:model="role"
                                    required
                                >
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ $userId ? 'Update User' : 'Create User' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
