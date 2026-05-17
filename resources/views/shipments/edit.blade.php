@extends('layout')

@section('content')





        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f6f9;
            }

            .form-container {
                width: 90%;
                max-width: 700px;
                margin: 40px auto;
                background: #fff;
                padding: 25px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            .form-title {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
                font-weight: bold;
            }

            input, select, textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 6px;
                font-size: 14px;
            }

            textarea {
                resize: vertical;
                min-height: 80px;
            }

            .btn {
                display: block;
                width: 100%;
                padding: 12px;
                background: #3498db;
                color: #fff;
                border: none;
                border-radius: 6px;
                font-size: 16px;
                cursor: pointer;
                transition: background 0.2s;
            }

            .btn:hover {
                background: #2980b9;
            }

            .error {
                color: red;
                font-size: 13px;
            }
        </style>

        <div class="form-container">
            <h2 class="form-title">Create New Shipment</h2>

            <form action="{{ route('shipments.update'), ['shipment' =>$shipment->id]}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{$shipment->title ?? ''}}">
                    @error('title') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="from_city">From City</label>
                    <input type="text" name="from_city" value="{{$shipment->from_city ?? ''}}" required>
                </div>

                <div class="form-group">
                    <label for="from_country">From Country</label>
                    <input type="text" name="from_country" value="{{ $shipment->from_country  ?? ''}}" required>
                </div>

                <div class="form-group">
                    <label for="to_city"l>To City</label>
                    <input type="text" name="to_city" value="{{ $shipment->to_city ?? ''}}" required>
                </div>

                <div class="form-group">
                    <label for="to_country">To Country</label>
                    <input type="text" name="to_country" value="{{ $shipment->to_country ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number"  name="user_id" value="{{ $shipment->price ?? ''}}" min="0" required>
                </div>



                <div class="form-group">

                    @if($errors->has('user_id'))
                        <p>{{$errors->first('user_id')}}</p>
                    @endif

                    <label for="user_id">Trucker ID</label>
                    <input type="number" name="user_id" value="{{ $shipment->user_id ?? ''}}" min="0" required>
                </div>


                <div class="form-group">

                    @if($errors->has('client_id'))
                        <p>{{$errors->first('client_id')}}</p>
                    @endif

                    <label for="user_id">Client ID</label>
                    <input type="number" name="client_id" value="{{ $shipment->client_id ?? ''}}" min="0" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        @foreach(\App\Models\Shipments::ALLOWED_STATUS as $status)
                            <option value="{{$status}}" {{$shipment->status===$status ? :'required'}}{{$status}}></option>

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>User ID</label>
                    <input type="number" name="user_id" value="{{ old('user_id') }}">
                </div>

                <div class="form-group">
                    <label for="documents">Documents</label>
                    <input type="file" name="documents[]" multiple>
                </div>

                <div class="form-group">
                    <label for="details">Details</label>
                    <textarea name="details" rows="4" required>{{$shipment->details ?? ''}} </textarea>
                </div>

                <div class="form-group">
                    <label>Details</label>
                    <textarea name="details">{{ old('details') }}</textarea>
                </div>

                <button type="submit" class="btn">Update Shipment</button>
            </form>
        </div>

    @endsection



