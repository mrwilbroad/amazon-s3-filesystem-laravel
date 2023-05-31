<h1 align="center">Welcome to mrwilbroad Laravel Project! Keep Coding</h1>
<img src="https://github.com/mrwilbroad/quality-images/raw/main/Screenshot%20from%202023-05-06%2000-37-01.png"/ alt="mrwilbroad amazon demostration">


# amazon-s3-filesystem-laravel
Setting Up Amazon S3 with Laravel

**This repository provides a guide to setting up Amazon S3 with Laravel**


***Download s3 file configuration to your project***

```terminal
composer require league/flysystem-read-only "^3.0"
```
**Prerequisites**
Before you begin, make sure you have the following:
- An Amazon Web Services account
- A Laravel project with a file storage requirement


1. **Create an Amazon S3 Bucket**
   - Log in to your AWS Management Console and navigate to the S3 console.
   - Click the "Create Bucket" button.
   - Type a unique bucket name and select the appropriate region.
   - Click the "Create Bucket" button at the bottom of the page.
   
 2. **Step 2: Create an IAM User and Group**
- From the search bar, search for IAM. This will create a user and user group to operate your filesystem.
- From the left-hand menu, click on "User groups".
- Click "Create group".
- Type in a group name.
- From the permissions list, search for "AmazonS3FullAccess" and assign this permission.
- Click "Create group".
- Back to the dashboard, go to "Users".
- Click "Add user".
- Fill in all required information as recommended by AWS.
- Remember to assign the group name to this user.

3. **Step 3: Create Access and Secret Keys**
- Back to the user dashboard, click on the user name from the table search.
- Navigate to "Security and Credential" to create Access and Secret keys for API calls.
- After completion, copy both the Access key and Secret key.

4. **Step 4: Configure Laravel**
- In the Laravel project, open the .env file.
- Add the following lines to set up the Amazon S3 driver:

```env
FILESYSTEM_DRIVER=s3
AWS_ACCESS_KEY_ID=<your-access-key-id>
AWS_SECRET_ACCESS_KEY=<your-secret-access-key>
AWS_DEFAULT_REGION=<your-region>
AWS_BUCKET=<your-bucket-name>
```


**NOW in your Laravel code**
- **Go to terminal and Type**
```terminal
php artisan make:controller FileSTorageTestController
```

**On Controller Level**
```php
  public function SaveFiles()
    {
        Storage::put('myfile.text',"Hello test file from laravel");
        return back();
    }
```

**Contact me at mrwilbroadmark@gmail.com com for questions and feedback.**
