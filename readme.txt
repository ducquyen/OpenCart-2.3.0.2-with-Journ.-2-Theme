#########################
OPENCART IMAGE CRUSHER
#########################

The Opencart image crusher is a module that compresses the jpegs previously uploaded to your site and also all future jpegs added via the image manager. 

You have the option to set the level of compression and also the ability to turn it off when it is not needed.


#########################
DEMO
#########################

Admin: 

USERNAME: demo
PASSWORD: demo

crush existing images
- enter catalog/demo and click crush images and watch as the images are compressed. 

http://www.paddysherry.com/image-crusher/2-0/admin/index.php?route=module/image_crusher&token=9c08226361ead3b07a0e693aa700778a

crush new images
- Upload a jpeg from your computer and see how much it is optimised.
http://www.paddysherry.com/image-crusher/2-0/admin/index.php?route=catalog/product/edit&token=b3ae4a6709d970b908989dcf6f414d3e&product_id=42
 

#########################
FAQ
#########################

Q: Can Image Crusher compress images that are live on my site now?
A: Yes, you enter a folder name and the Module will scan all the images in this directory and all subdirectories for images. It will then compress all of the jpegs it finds.

Q: Will this work for all image types?
A: This version of Image Crusher is for JPEG’s only. We are adding support for PNG’s and GIF’s in our next iteration.

Q: What happens the original file?
A: The original file stays on your computer, untouched.

Q: Can I set the compression level
A: Yes, this can be set from 1-10 in the admin

Q: What compression level do you re-commend?
A: Level 7 is a good choice for sharp images that are small in size.

Q: What if I upload another file type?
A: If you upload any other image type it will simply be processed as normal and the Image Crusher will not touch it.

Q: Can I turn it off in the Admin?
A: Yes, you can set the Image Crusher to off if it is not needed.

Q: What is the maximum file size?
A: The default Opencart value is 300kb but you can change this yourself.

Q: What if the image quality is poor?
A: If you select Level 10 compression your images will still be good as the module applies a threshold in the background to ensure the image quality does not come out too bad.

Q: Will this work with multi image uploader?
A: Image Crusher has been tested against Multi Image Uploader and both modules work perfectly side by side. This is because Multi Image Uploader bypasses the image manager and uploads straight from your computer. 

Therefore, if you upload multiple images they will not get any optimisation. You need to upload one by one through the image manager to get the goodness of Image Crusher.

#########################
INSTALLATION
#########################
Ensure vqmod is installed (Download here if you don’t already have it: https://github.com/vqmod/vqmod/releases) Take the Opencart version.
Download the Image Crusher package.
Upload the files to the root of you opencart store.
Go to your admin and Extensions > Modules.
You should see Image Crusher in the list. Click Install.
Click Edit.
By default the image crusher will be turned on.
Select the level of compression you want. Higher compression = smaller file size!
Click Save. 

All images uploaded through the image manager will now be compressed automatically. You will receive a popup that shows you the how much the Image Crusher reduced your file size by.

You can also compress all the images that are live on your site. Just make sure you clear your image cache afterwards.


#########################
UPGRADING
#########################

If you are upgrading from a previous version of Image Crusher, simply copy over the existing files on your server and reload your admin.

If you have upgraded your site to Opencart 2.0+, make sure to download the correct version of this module for your open cart store


#########################
PROBLEM SOLVING
#########################

Ensure the module has permissions. Go to System>Users>User Groups>Top Administrator.
Ensure module/image_crusher is checked for access permission and modify permission.

Delete your vqmod cache files

Clear your site cache.


#########################
SUPPORT
#########################

If you require and assistance drop me a line at hello@paddysherry.com