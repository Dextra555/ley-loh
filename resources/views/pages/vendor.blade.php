@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'typography'
])

@section('content')
<style>
  .upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
   
  }
 
  .file-input {
    display: none;
  }
  .file-label {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    position: relative;
    margin-bottom: 5px;
  }
  .file-label:hover {
    background-color: #0056b3;
  }
  .remove-btn {
    background-color: transparent;
    border: none;
    padding: 0;
    margin: 0;
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    display: none;
  }
  .file-label:hover .remove-btn {
    display: block;
  }
</style>

<div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
        
      <div class="form-group">
        <label for="mobile_number">Mobile Number:</label>
        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" required>
      </div>
      
      
      <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" class="form-control" id="location" name="location">
      </div>
      
      

      <div class="form-group">
        <label for="industry_type">Industry Type:</label>
        <select class="form-control" id="industry_type" name="industry_type">
          <option value="Technology">Store</option>
          <option value="Restarent">Restarent</option>
          <option value="Healthcare">Hostel</option>
          <option value="Education">Store</option>
          <!-- Add more options as needed -->
        </select>
      </div>
      <div class="form-group">
    <div class="upload-container">
        <label for="icon_image">Icon Image:</label>
        <input type="file" id="fileInput" class="file-input" name="icon_image">
        <label for="fileInput" class="file-label">Choose File</label>
    </div>
</div>


      <center><button type="submit" class="btn btn-primary register">Register</button></center>
                </form>


</div>
</div>
</div>

<!-- <<script>
  const fileInput = document.getElementById('fileInput');
  
  // fileInput.addEventListener('change', handleFileSelect);
  
  function handleFileSelect(event) {
    const fileList = event.target.files;
    const uploadContainer = document.querySelector('.upload-container');
    for (let i = 0; i < fileList.length; i++) {
      const fileName = fileList[i].name;
      const fileLabel = document.createElement('label');
      fileLabel.textContent = fileName;
      fileLabel.className = 'file-label';
      const removeBtn = document.createElement('button');
      removeBtn.innerHTML = '&times;';
      removeBtn.className = 'remove-btn';
      removeBtn.addEventListener('click', () => {
        fileInput.value = '';
        uploadContainer.removeChild(fileLabel);
      });
      fileLabel.appendChild(removeBtn);
      uploadContainer.appendChild(fileLabel);
    }
  }
</script>  -->
<!-- <script>
    const fileInput = document.getElementById('fileInput');
    const uploadContainer = document.querySelector('.upload-container');
    
    fileInput.addEventListener('change', handleFileSelect);
    
    function handleFileSelect(event) {
        // Remove any existing file label
        const existingFileLabel = uploadContainer.querySelector('.file-label');
        if (existingFileLabel) {
            uploadContainer.removeChild(existingFileLabel);
        }

        // Create label for the selected file
        const fileList = event.target.files;
        if (fileList.length > 0) {
            const fileName = fileList[0].name;
            const fileLabel = document.createElement('label');
            fileLabel.textContent = fileName;
            fileLabel.className = 'file-label';

            // Append label to upload container
            uploadContainer.appendChild(fileLabel);
        }
    }
</script> -->

<script>
    const fileInput = document.getElementById('fileInput');
    const uploadContainer = document.querySelector('.upload-container');
    
    fileInput.addEventListener('change', handleFileSelect);
    
    function handleFileSelect(event) {
        // Remove any existing file label
        const existingFileLabel = uploadContainer.querySelector('.file-label');
        if (existingFileLabel) {
            uploadContainer.removeChild(existingFileLabel);
        }

        // Create label for the selected file
        const fileList = event.target.files;
        if (fileList.length > 0) {
            const fileName = fileList[0].name;
            const fileLabel = document.createElement('label');
            fileLabel.textContent = fileName;
            fileLabel.className = 'file-label';

            // Append label to upload container
            uploadContainer.appendChild(fileLabel);
        }
    }
</script>
@endsection