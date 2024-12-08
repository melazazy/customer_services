@extends('layouts.app')

@section('content')
        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8 !important">
            <div class="service-card">
                <div class="service-content">
                    <form wire:get="save">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>



    </div>
@endsection
