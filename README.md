# SCropper

This class provides you crop images of jpeg, jpg, png, bmp, gif each type has a handler of it own so if you want to add new extension just add new handler and you are good to go.

## How To Use
```
$cropper = new SCropperFactory();
echo $cropper->getCropper($data)->crop();
```

### Parameters

** $data is an array with these keys.
- **src: the /path/to/image you need to crop
- **width: the width you wish to crop the image
- **height: the height you wish to crop the image
- **x: the x position of image you wish to crop the image (if empty then by default it is 0)
- **x: the y position of image you wish to crop the image (if empty then by default it is 0)
- **target: the /path/to/croopedimage (if empty the cropped image save to same path of src with timestamp in its name)

## Want To Create New Image Handler

1. Create a php class
2. name that class like XXXHandler where XXX is extension of file in uppercase letters
3. extends that class with [Handler]
4. Override two methods
    -**setup: in this you need to validate either image is possible to crop or not
    -**process: in this function you need to write croping script and return save that to target path and return the target path
5. All done.