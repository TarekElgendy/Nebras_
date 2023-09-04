<?php

use App\Models\Cart;
use Faker\Factory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

function encodeId($id)
{
    return Crypt::encrypt($id);
}//encodeId

function decodeId($encodedId)
{
    try {
        return Crypt::decrypt($encodedId);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return null;
    }
}//decodeId

if (!function_exists('stock')) {
function stock($stock)
{
        if($stock<=0){
            return 'outOfStock';
        }else{
            return 'inStock';
        }
}
}//stock


function createFileZip($files)
{
    // Create a temporary ZIP file to hold the files
    $zipFile = public_path('path/to/temp.zip');

    // Create a new ZIP archive
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Add each file to the ZIP archive
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }

        // Close the ZIP archive
        $zip->close();

        // Return the link for the ZIP file
        return asset('path/to/temp.zip');
    }

    // If the ZIP archive failed to be created, return null
    return null;
}



if (!function_exists('currency')) {
    function currency()
    {
        if(app()->getLocale()=='ar'){

            return 'ريال';
        }else{
            return 'SAR';

        }
    }
} //end get currency

function formatDate($date)
{
    return Carbon::parse($date)->format('Y-M');
} //end of formatDate

if (!function_exists('userTagID')) {
    function userTagID()
    {
        return 'ID: PR';
    }
} //end get userTagID


if (!function_exists('calculateDiscount')) {
    function calculateDiscount($oldPrice, $newPrice)
    {
        if ($oldPrice <= 0 || $newPrice <= 0) {
            return 'Prices must be positive values.';
        }

        if ($oldPrice <= $newPrice) {
            return 'New price must be lower than the old price.';


        }

        $discountPercentage = (($oldPrice - $newPrice) / $oldPrice) * 100;
        return number_format($discountPercentage, 0);
    }

} //end get calculateDiscount





if (!function_exists('pageType')) {
    function pageType()
    {
        $modules = [
            'sliders',
            'sliderBoxs',


            'homePageAd_3Box',
            'homePageAdLarge_2Box',
            'homePageAdSmall_2Box',
            'SinglePage_SideBox',


            'blogs',



            'testimonials',
            'aboutUs',
            'jobs'




        ];
        // Log::info($modules);
        return $modules;
    }
} //end get pageType
if (!function_exists('poweredBy')) {
    function poweredBy()
    {
        $modules = [
            'electricity',
            'water',
            'air',
            'battery',
            'manual',
            'naturalGas'
        ];
        // Log::info($modules);
        return $modules;
    }
} //end get poweredBy

if (!function_exists('majorTypes')) {
    function majorTypes()
    {
        $items = ['competencies', 'orderMaterials'];
        // Log::info($items);
        return $items;
    }
} //end get majorTypes

if (!function_exists('lblClass')) {
    function lblClass($type)
    {
        if ($type == 'create') {
            $lbl_class = 'bg-blue-gradient';
        } elseif ($type == 'read') {
            $lbl_class = 'bg-maroon';
        } elseif ($type == 'update') {
            $lbl_class = 'bg-yellow-gradient';
        } elseif ($type == 'delete') {
            $lbl_class = 'bg-red-gradient';
        }
        return $lbl_class;
    }
} //end get lblClass

//

if (!function_exists('recommendDimension')) {
    function recommendDimension($page, $part)
    {
        if ($page == 'sections' && $part == 'image') {
            $width = '30px';
            $height = '20px';
        } elseif ($page == 'sections' && $part == 'icon') {
            $width = '304px';
            $height = '203px';
        } else {
            $width = ' ';
            $height = ' ';
        }
        return 'Recommended W=' . $width . '& H:' . $height;
    }
} //end get recommendDimension

if (!function_exists('typCategories')) {
    function typCategories()
    {
        $modules = ['category', 'flagHome','collection'];

        return $modules;
    }
} //end get typCategories
if (!function_exists('activeOrinactive')) {
    function activeOrinactive()
    {
        $modules = ['active', 'inactive'];
        // Log::info($modules);
        return $modules;
    }
} //end get activeOrinactive

if (!function_exists('typeAds')) {
    function typeAds()
    {
        $modules = ['Home', 'SinglePage'];
        // Log::info($modules);
        return $modules;
    }
} //end get typeAds

if (!function_exists('typeProductItems')) {
    function typeProductItems()
    {
        $modules = ['techniques', 'techniquesItems', 'advantages', 'materials', 'finishes', 'gallery', 'comparisonTable'];
        // Log::info($modules);
        return $modules;
    }
} //end get typeProductItems

if (!function_exists('lbl_status')) {
    function lbl_status($status)
    {
        if ($status == 'active') {
            $lbl = 'fa fa-circle text-success';
        } else {
            $lbl = 'fa fa-circle text-danger';
        }
        return "<i class='$lbl'></i>" . __('dash.' . $status);
    }
} //end get lbl_status

if (!function_exists('getModels')) {
    function getModels()
    {
        $modules = [

            // 'dashboard',
            'users',
            'orders',
            'offers',
            //  'timeLines',
            //   'wallets',
            'inboxs',
            'brands',
            'ads',

            'sections',
            'categories',
            'products',
            //    'productitems',
            //   'majors',
            //  'majorCategories',
            // 'countries',
            'cities',
            'states',
            'pages',
            'settings',
            'admins',
            'roles',
        ];
        // Log::info($modules);
        return $modules;
    }
} //end get models
if (!function_exists('socailMedia')) {
    function socailMedia()
    {
        $modules = ['facebook', 'twitter', 'instagram', 'tiktok', 'youtube', 'linkedin', 'snapchat', 'pinterest'];
        // Log::info($modules);
        return $modules;
    }
} //end get socailMedia
if (!function_exists('make_slug')) {
    function make_slug($string)
    {
        $text = html_entity_decode(mb_strtolower($string), ENT_QUOTES, 'UTF-8');
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');

        return $text;
    }
} //end of make slug
if (!function_exists('upload_img')) {
    function upload_img($request, $path, $resize)
    {
        if ($request->getClientOriginalExtension() == 'svg') {
            $fileName = time() . '.' . $request->getClientOriginalExtension();
            $request->move(public_path($path), $fileName);
            return $fileName;
        } else {
            $image = Image::make($request);

            if ($image->mime() === 'image/svg+xml') {
                // Handle SVG images separately
                $fileName = time() . '.svg';
                $image->save(public_path($path . $fileName));
                return $fileName;
            } else {
                $fileName = time() . '.webp';
                $image->resize($resize, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('webp', 100); // Convert and set WebP quality (adjust as needed)

                $image->save(public_path($path . $fileName));
                return $fileName;
            }
        }
    }

    // function upload_img($request, $path, $resize)
    // {
    //     if ($request->getClientOriginalExtension() == 'svg') {
    //         $fileName = time() . '.' . $request->extension();
    //         $request->move(public_path($path), $fileName);
    //         return $fileName;
    //     } else {
    //         Image::make($request)
    //             ->resize($resize, null, function ($constraint) {
    //                 $constraint->aspectRatio();
    //             })
    //             ->save(public_path($path . $request->hashName()));
    //     }

    //     return $request->hashName();
    // }
} //end of upload_img




if (!function_exists('authUser')) {
    function authUser()
    {
        return auth()->user();
    }
} //end of authUser

if (!function_exists('MultipleUploadFiles')) {
    function MultipleUploadFiles($requests, $path)
    {
        $data = [];
        foreach ($requests as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);
            $data[] = $filename;
        }

        return $data;
    }
} //end MultipleUploadFiles

if (!function_exists('MultipleUploadImages')) {
    function MultipleUploadImages($requests, $path, $resize)
    {
        // $data = [];
        // foreach ($requests as $attach) {
        //     Image::make($attach)
        //         ->resize($resize, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })
        //         ->save(public_path($path . $attach->hashName()));
        //     $data[] = $attach->hashName();
        // }
        // return $data;

        $data = [];

        foreach ($requests as $attach) {
            $image = Image::make($attach);
            $fileName = time() . '.webp'; // Use .webp extension for WebP format

            $image->resize($resize, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('webp', 100); // Convert to WebP with quality set to 100

            $image->save(public_path($path . $fileName));
            $data[] = $fileName;
        }

        return $data;
    }
} //end multiple upload image

if (!function_exists('fake')) {
    function fake($type)
    {
        $faker = Factory::create();
        if ($type == 'imageUrl') {
            $value = $faker->imageUrl;
        }
        if ($type == 'name') {
            $value = $faker->name;
        }
        if ($type == 'address') {
            $value = $faker->address;
        }
        if ($type == 'text') {
            $value = $faker->text;
        }
        if ($type == 'sentence') {
            $value = $faker->sentence;
        }
        if ($type == 'word') {
            $value = $faker->word;
        }
        if ($type == 'paragraph') {
            $value = $faker->word;
        }
        if ($type == 'sku') {

            $value = $faker->unique()->numerify('SKU#####');
        }


        echo $value;
    }
} //end of fake

if (!function_exists('orderStatus')) {
    function orderStatus()
    {
        $orderStatus = ['pending', 'receiveOffers', 'inProgress', 'completed', 'canceld', 'underReview'];
        // Log::info($orderStatus);
        return $orderStatus;
    }
} //end get orderStatus

if (!function_exists('cutText')) {
    function cutText($text, $maxLength)
    {
        // Split the text string into an array of words
        $words = preg_split('/\s+/u', $text);

        // If the text string has less than three words, return the full text string
        if (count($words) <= 3) {
            return $text;
        }

        // Loop through the words array and concatenate each word to a new string
        // until the new string is at least $maxLength characters long
        $newText = '';
        foreach ($words as $word) {
            $newText .= $word . ' ';
            if (mb_strlen($newText, 'UTF-8') >= $maxLength) {
                break;
            }
        }

        // Trim the new text string and add an ellipsis at the end
        $newText = trim($newText) . '...';

        return $newText;
    }
} //end of cutText
