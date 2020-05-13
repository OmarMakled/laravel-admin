<?php

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    private $types = [
        ['en' => 'Apartments & Duplex for Sale,', 'ar' => 'شقق و دوبلكس للبيع'],
        ['en' => 'Villas For Rent,', 'ar' => 'فلل للإيجار'],
        ['en' => 'Commercial for Sale', 'ar' => 'عقار تجارى للبيع'],
        ['en' => 'Apartments & Duplex for Rent', 'ar' => 'شقق و دوبلكس للإيجار'],
        ['en' => 'Vacation Homes for Sale', 'ar' => 'عقارات مصايف للبيع'],
        ['en' => 'Commercial for Rent', 'ar' => 'عقار تجارى للإيجار'],
        ['en' => 'Villas For Sale', 'ar' => 'فلل للبيع'],
        ['en' => 'Vacation Homes for Rent', 'ar' => 'عقارات مصايف للإيجار'],
        ['en' => 'Buildings & Lands', 'ar' => 'مبانى و أراضى'],
    ];

    private $amenities = [
        ['en' => 'Balcony', 'ar' => 'شرفة'],
        ['en' => 'Built in Kitchen Appliances', 'ar' => 'أجهزة المطبخ'],
        ['en' => 'Private Garden', 'ar' => 'حديقة خاصة'],
        ['en' => 'Central A/C & heating', 'ar' => 'تدفئة وتكييف مركزي'],
        ['en' => 'Security', 'ar' => 'أمن'],
        ['en' => 'Covered Parking', 'ar' => 'موقف سيارات مغطى'],
        ['en' => 'Maids Room', 'ar' => 'غرفة خدم'],
        ['en' => 'Pets Allowed', 'ar' => 'مسموح بالحيوانات الاليفة'],
        ['en' => 'Pool', 'ar' => 'حمام سباحة'],
        ['en' => 'Electricity Meter', 'ar' => 'عداد كهرباء'],
        ['en' => 'Water Meter', 'ar' => 'عداد مياه'],
        ['en' => 'Natural Gas', 'ar' => 'غاز طبيعى'],
        ['en' => 'Elevator', 'ar' => 'أسانسير'],
        ['en' => 'Landline', 'ar' => 'تليفون أرضى'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::truncate();
        foreach ($this->types as $type) {
            $attribute = new Attribute;
            $attribute->setTranslations('title', $type);
            $attribute->type = Attribute::TYPE;
            $attribute->save();
        }

        foreach ($this->amenities as $amenity) {
            $attribute = new Attribute;
            $attribute->setTranslations('title', $amenity);
            $attribute->type = Attribute::AMENITY;
            $attribute->save();
        }
    }
}
