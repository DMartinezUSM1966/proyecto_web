<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehiculo::insert([
            // Alfa Romeo
            [
                'año' => '2018',
                'marcaVehiculo' => 3,
                'tipo_vehiculo_id' => 2, // Deportivo
                'modelo' => 'Giulia Quadrifoglio',
                'patente' => 'AR0001',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://s3.amazonaws.com/cka-dash/006-0321-AFO16805/model1.png',
            ],
            [
                'año' => '2017',
                'marcaVehiculo' => 3,
                'tipo_vehiculo_id' => 3, // SUV
                'modelo' => 'Stelvio',
                'patente' => 'AR0002',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://medias.fcacanada.ca/jellies/renditions/2024/800x510/CC24_GUGL74_2DM_PRR_APA_XXX_XXX_XXX.543af090d02f579f41d95d6fd78ad16d.png',
            ],
            [
                'año' => '2019',
                'marcaVehiculo' => 3,
                'tipo_vehiculo_id' => 4, // Sedán
                'modelo' => 'Giulietta',
                'patente' => 'AR0004',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://pngimg.com/d/alfa_romeo_PNG69.png',
            ],
            [
                'año' => '2021',
                'marcaVehiculo' => 3,
                'tipo_vehiculo_id' => 5, // Coupé
                'modelo' => '4C Spider',
                'patente' => 'AR0005',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://di-uploads-pod3.dealerinspire.com/zeigleralfaromeoofschaumburg/uploads/2019/04/2019-Alfa-Romeo-4C-Spider-MLP-Hero.png',
            ],
            [
                'año' => '2018',
                'marcaVehiculo' => 3,
                'tipo_vehiculo_id' => 6, // Camioneta
                'modelo' => 'Tonale',
                'patente' => 'AR0006',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://di-uploads-pod21.dealerinspire.com/brownsalfaromeo/uploads/2023/08/mlp-img-top-2024-tonale.png',
            ],
            
            [
                'año' => '2020',
                'marcaVehiculo' => 3,
                'tipo_vehiculo_id' => 2, // Deportivo
                'modelo' => '4C',
                'patente' => 'AR0008',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://pngimg.com/d/alfa_romeo_PNG55.png',
            ],
        
           
            [
                'año' => '2019',
                'marcaVehiculo' => 3,
                'tipo_vehiculo_id' => 4, // Sedán
                'modelo' => 'Giulietta Veloce',
                'patente' => 'AR0010',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://pngimg.com/d/alfa_romeo_PNG23.png',
            ],

            // Audi
            [
                'año' => '2021',
                'marcaVehiculo' => 2,
                'tipo_vehiculo_id' => 2, // Deportivo
                'modelo' => 'R8 V10 Performance',
                'patente' => 'AU0001',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.carprices.com/pricebooks_data/usa/colorized/2023/Audi/View2/R8_Spyder/V10_Performance_quattro/4SRRBE_T9.png',
            ],
            [
                'año' => '2023',
                'marcaVehiculo' => 2,
                'tipo_vehiculo_id' => 4, // Sedán
                'modelo' => 'A6',
                'patente' => 'AU0002',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.dealer.com/ddc/vehicles/2021/Audi/A6/Sedan/perspective/front-left/2021_76.png',
            ],
            [
                'año' => '2022',
                'marcaVehiculo' => 2,
                'tipo_vehiculo_id' => 3, // SUV
                'modelo' => 'Q5',
                'patente' => 'AU0003',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.dealer.com/ddc/vehicles/2022/Audi/Q5/SUV/trim_45_S_line_Premium_198e80/perspective/front-left/2022_76.png',
            ],
            [
                'año' => '2020',
                'marcaVehiculo' => 2,
                'tipo_vehiculo_id' => 5, // Coupé
                'modelo' => 'A5',
                'patente' => 'AU0004',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://i.pinimg.com/originals/88/c5/90/88c5901adf2ddb743b049f420c9ef131.png',
            ],
            [
                'año' => '2021',
                'marcaVehiculo' => 2,
                'tipo_vehiculo_id' => 6, // Camioneta
                'modelo' => 'Q7',
                'patente' => 'AU0005',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.carprices.com/pricebooks_data/usa/colorized/2024/Audi/View2/Q7/55_TFSI/4MGAX2_F0.png',
            ],

            // Ferrari
            [
                'año' => '2022',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 1, // Superdeportivo
                'modelo' => 'Ferrari SF90 Stradale',
                'patente' => 'FE0001',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://vrrb-fsb-prod-backend.s3.us-west-1.amazonaws.com/strapi/SF_90_Stradale_Thumb_500a464bf7.png',
            ],
            [
                'año' => '2023',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 1, // Superdeportivo
                'modelo' => 'Ferrari 812 Competizione',
                'patente' => 'FE0002',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://vrrb-fsb-prod-backend.s3.us-west-1.amazonaws.com/strapi/812_competizione_thumb_4dc7c91d98.png',
            ],
            [
                'año' => '2021',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 2, // Deportivo
                'modelo' => 'Ferrari F8 Tributo',
                'patente' => 'FE0003',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://prestigecarhire.co.uk/wp-content/uploads/2022/07/F8-Tributo.png',
            ],
            [
                'año' => '2022',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 2, // Deportivo
                'modelo' => 'Ferrari Portofino M',
                'patente' => 'FE0004',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://cdn.ferrari.com/cms/network/media/img/resize/5f60fede966ae519cbd62beb-ferrari-portofino-m-design-hotspot-mob-new_3?',
            ],
            [
                'año' => '2020',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 3, // SUV
                'modelo' => 'Ferrari Purosangue',
                'patente' => 'FE0005',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://cdn.ferrari.com/cms/network/media/img/resize/631f431c482135455e01f05c-ferrari-purosangue-crop-line-up?width=800&height=600',
            ],
            [
                'año' => '2021',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 1, // Sedán
                'modelo' => 'Ferrari GTC4Lusso',
                'patente' => 'FE0006',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://www.motortrend.com/uploads/sites/5/2020/06/2020-ferrari-gtc4lusso.png',
            ],
            [
                'año' => '2023',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 1, // Superdeportivo
                'modelo' => 'Ferrari LaFerrari',
                'patente' => 'FE0007',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://i.pinimg.com/originals/17/27/0f/17270fb6b3c174daae51ec6ba0415c4d.png',
            ],
            [
                'año' => '2020',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 1, // Superdeportivo
                'modelo' => 'Ferrari Roma',
                'patente' => 'FE0008',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://vrrb-prod-s3.s3.us-west-1.amazonaws.com/strapi/Roma_Spider_Thumb_c51080d0d0.png',
            ],
            [
                'año' => '2022',
                'marcaVehiculo' => 4,
                'tipo_vehiculo_id' => 2, // Deportivo
                'modelo' => 'Ferrari 488 Pista',
                'patente' => 'FE0009',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://car-rent.powerserviceluxurycarhire.com/wp-content/uploads/2020/02/488-pista.png',
            ],

            // Lamborghini
            [
                'año' => '2022',
                'marcaVehiculo' => 1,
                'tipo_vehiculo_id' => 1, // Superdeportivo
                'modelo' => 'Aventador SVJ',
                'patente' => 'LB0001',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://www.pngall.com/wp-content/uploads/5/Lamborghini-Aventador-PNG-File.png',
            ],
            [
                'año' => '2021',
                'marcaVehiculo' => 1,
                'tipo_vehiculo_id' => 1, // Deportivo
                'modelo' => 'Huracan EVO',
                'patente' => 'LB0002',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://imgs.search.brave.com/5aKqWXZupClaR-wzddkqUnidixSHlbrT-TjQcJ9Ffcs/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9mcmVl/Ymllc2Nsb3VkLmNv/bS93cC1jb250ZW50/L3VwbG9hZHMvMjAy/MS8wMy9MYW1ib3Jn/aGluaS1IdXJhY2Fu/LUV2by1TcHlkZXIt/MjAyMC01LnBuZw',
            ],
            [
                'año' => '2020',
                'marcaVehiculo' => 1,
                'tipo_vehiculo_id' => 3, // SUV
                'modelo' => 'Urus',
                'patente' => 'LB0003',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://www.lamborghini.com/sites/it-en/files/DAM/lamborghini/facelift_2019/model_gw/urus/2024/model_chooser/Model%3DUrus%20SE%2C%20Type%3DMobile.png',
            ],
            [
                'año' => '2021',
                'marcaVehiculo' => 1,
                'tipo_vehiculo_id' => 1, // Deportivo
                'modelo' => 'Huracan STO',
                'patente' => 'LB0008',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.carandbike.com/car-images/colors/lamborghini/huracan-sto/lamborghini-huracan-sto-blu-uranus-matt.png?v=1645177019',
            ],
            [
                'año' => '2020',
                'marcaVehiculo' => 1,
                'tipo_vehiculo_id' => 1, // Superdeportivo
                'modelo' => 'Veneno',
                'patente' => 'LB0010',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://www.pngmart.com/files/22/Lamborghini-Veneno-Transparent-PNG.png',
            ],

            // Mercedes Benz
            [
                'año' => '2022',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 1, // Superdeportivo
                'modelo' => 'Mercedes-AMG One',
                'patente' => 'MB0001',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.oneweb.mercedes-benz.com/customersolutions/medienbank_im/BIG_Artikel_HB_800x600/187966.png?imwidth=800',
            ],

            [
                'año' => '2021',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 3, // SUV
                'modelo' => 'Mercedes-Maybach GLS 600',
                'patente' => 'MB0003',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.dealer.com/ddc/vehicles/2023/Mercedes-Benz/Maybach%20GLS%20600/SUV/trim_Base_a8d3f2/perspective/front-left/2023_24.png',
            ], 

            [
                'año' => '2020',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 4, // Sedán
                'modelo' => 'Mercedes-Benz S-Class',
                'patente' => 'MB0004',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://crdms.images.consumerreports.org/c_lfill,w_470,q_auto,f_auto/prod/cars/cr/model-years/14395-2022-mercedes-benz-s-class',
            ],
            [
                'año' => '2022',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 5, // Coupé
                'modelo' => 'Mercedes-AMG C63 S Coupé',
                'patente' => 'MB0005',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://www.gt-luxury.com/wp-content/uploads/2016/02/c63-s-png.png',
            ],
            [
                'año' => '2021',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 6, // Camioneta
                'modelo' => 'Mercedes-Benz GLE Coupe',
                'patente' => 'MB0006',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://di-uploads-pod7.dealerinspire.com/mercedesbenzburlingtonca/uploads/2018/02/2018-Mercedes-Benz-GLE-S-63-4MATIC-Coupe-PNG-Banner-Image-600-copy.png',
            ],
            [
                'año' => '2020',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 7, // Jeep
                'modelo' => 'Mercedes-Benz G-Class',
                'patente' => 'MB0007',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://pngimg.com/d/mercedes_PNG1896.png',
            ],

            [
                'año' => '2021',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 2, // Deportivo
                'modelo' => 'Mercedes-AMG GT 63 S',
                'patente' => 'MB0009',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://images.dealer.com/ddc/vehicles/2020/Mercedes-Benz/AMG%20GT%2063/Hatchback/perspective/front-left/2020_76.png',
            ],
            [
                'año' => '2020',
                'marcaVehiculo' => 5,
                'tipo_vehiculo_id' => 3, // SUV
                'modelo' => 'Mercedes-AMG GLE 63 S',
                'patente' => 'MB0010',
                'estado_vehiculo' => 1,
                'url_imagen' => 'https://w7.pngwing.com/pngs/326/399/png-transparent-mercedes-benz-m-class-sport-utility-vehicle-mercedes-benz-gle-class-car-mercedes-benz-compact-car-car-mercedesbenz-sclass.png',
            ],
        ]);
    }
}
