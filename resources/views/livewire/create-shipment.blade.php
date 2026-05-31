<div>

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

    <form class="form-container" wire:submit="submit">

        @foreach($errors->all() as $error)
             {{$error}}
        @endforeach

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" wire:model="title" required>
            @error('title') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="from_city">From City</label>
            <input type="text"  wire:model="fromCity" required>
        </div>

        <div class="form-group">
            <label for="from_country">From Country</label>
            <input type="text"  wire:model="fromCountry"  required>
        </div>

        <div class="form-group">
            <label for="to_city">To City</label>
            <input type="text"  wire:model="toCity" required>
        </div>

        <div class="form-group">
            <label for="to_country">To Country</label>
            <input type="text"  wire:model="toCountry">

        </div>

        <div class="form-group">
            <label for="client">Client</label>
            @error('clientId')
            <p>{{$message}}</p>
            @enderror
            <input type="number" wire:blur="ValidateUser" wire:model="clientId">
        </div>


        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" wire:model="price">
        </div>



        <div class="form-group">

            <select wire:model="status">
                @foreach($statuses as $singleStatus)

                    <option value="{{$singleStatus}}">{{$singleStatus}}</option>

                @endforeach


            </select>

        </div>

        <div class="form-group">
            <label for="documents">Documents</label>
            <input type=file" wire:model="documents" multiple required>
        </div>

        <div class="form-group">
            <label for="details">Details</label>
            <textarea wire:model="details" rows="4" required></textarea>
        </div>

        <button>Ctreate shipment</button>



    </form>





</div>
