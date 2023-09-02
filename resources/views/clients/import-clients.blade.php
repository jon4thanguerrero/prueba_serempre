<!DOCTYPE html>
<html>
<head>
    <title>Subir Archivo Excel</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        div {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message-success {
            background-color: #28a745;
            color: #fff; 
            padding: 10px;
            border-radius: 4px; 
            margin-top: 10px; 
            font-weight: bold;
            text-align: center; 
        }

        .message-error {
            background-color: #ff0000;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            font-weight: bold;
            text-align: center;
        }

        
    </style>
</head>
<body>
    <div>
        <h2>Cargar clientes</h2>

        <form action="{{ route('import-clients') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="archivo_excel">Selecciona un archivo Excel:</label>
                <input type="file" name="file_excel" id="file_excel">
            </div>

            <button type="submit">Subir Excel</button>
        </form>
    </div>

    @if(isset($message))
        @if($success)
            <div class="message-success">
                {{ $message }}
            </div>
        @else
            <div class="message-error">
                {{ $message }}
            </div>
        @endif
    @endif

</body>
</html>

<script>
    // Function to hide the message after 3 seconds
    setTimeout(function() {
        var messageSuccess = document.querySelector('.message-success');
        if (messageSuccess) {
            messageSuccess.style.display = 'none';
        }

        var messageError = document.querySelector('.message-error');
        if (messageError) {
            messageError.style.display = 'none';
        }
    }, 3000);
</script>