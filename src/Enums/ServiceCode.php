<?php

namespace SmartDato\ProCarrier\Enums;

enum ServiceCode: string
{
    // Yodel Services
    case YODEL_WORLD_PACKET = 'EPS';
    case YODEL_WORLD_PARCEL = 'EPL';
    case CI_48HR_POD = '1CEP';
    case CI_48_N_POD = '1CEN';
    case XPECT_24_XL_POD = '1VSP';
    case XPECT_48_XL_POD = '2VLP';
    case XPECT_48_RTN_POD = '2VPR';
    case XPECT_24_N_POD = '1VSN';
    case XPECT_48_POD = '2VP';
    case XPECT_48_N_POD = '2VN';
    case XPECT_48_XL_N_POD = '2VLN';
    case XPRESS_24_POD = '1CP';
    case XPRESS_24_N_POD = '1CN';
    case XPRESS_48_POD = '2CP';
    case XPRESS_48_N_POD = '2CN';
    case XPRESS_MINI_N_POD = '2CMN';
    case XPRESS_SP_48_N_POD = '2CXN';
    case XPERT_24_ADDRESS_ONLY = '1VA';
    case XPECT_48_MINI_N_POD = '2VSN';
    case XPECT_48_MEDIUM_POD = '2VMP';
    case XPECT_48_MEDIUM_N_POD = '2VMN';
    case XPECT_24_MEDIUM_N_POD = '1VMN';
    case XPECT_24_MEDIUM_POD = '1VMP';
    case XPECT_24_XXL_POD = '1XXP';
    case XPECT_48_XXL_POD = '2XXP';
    case XPECT_24_XXL = '1XXN';
    case XPECT_48_XXL = '2XXN';

    // Pro Carrier Services
    case PRO_CARRIER_B2B = 'PCBB';
    case PRO_CARRIER_PACKET = 'PCPT';
    case PRO_CARRIER_PARCEL_POST = 'PCPP';
    case PRO_CARRIER_PLUS = 'PCPL';
    case PRO_CARRIER_PLUS_EXPEDITED = 'PCPX';
    case PRO_CARRIER_PARCEL_UK = 'PCUK';
    case PRO_CARRIER_PARCEL_EXPRESS = 'PCPE';
    case PRO_CARRIER_PARCEL_PUDO = 'PCPD';
    case PRO_CARRIER_PARCEL_PLUS_RETURNS = 'PCPR';
    case PRO_CARRIER_NEXT_DAY = 'PCND';
    case PRO_CARRIER_UK_24 = 'PC24';
    case PRO_CARRIER_UK_48 = 'PC48';
    case PRO_CARRIER_UK_NEXT_DAY_1030 = 'PCT3';
    case PRO_CARRIER_NEXT_DAY_PRE_12 = 'PC12';
    case PRO_CARRIER_UK_SATURDAY = 'PCST';
    case PRO_CARRIER_UK_SUNDAY = 'PCSU';
    case PRO_CARRIER_UK_BAG_IT = 'PCBI';
    case PRO_CARRIER_UK_LETTER = 'PCLL';
    case PRO_CARRIER_DIRECT = 'PCCN';

    // Royal Mail Services
    case TRACKED_24_NO_SIGNATURE = 'TPNN';
    case TRACKED_24_SIGNATURE = 'TPNS';
    case TRACKED_48_NO_SIGNATURE = 'TPSN';
    case TRACKED_48_SIGNATURE = 'TPSS';
    case INTERNATIONAL_BUSINESS_PARCELS_TRACKED = 'MP27';
    case TRACKED_LETTER_BOXABLE_24_NO_SIGNATURE = 'TRNN';
    case TRACKED_LETTER_BOXABLE_24_SIGNATURE = 'TRNS';
    case TRACKED_LETTER_BOXABLE_48_NO_SIGNATURE = 'TRSN';
    case TRACKED_LETTER_BOXABLE_48_SIGNATURE = 'TRSS';

    public function getDescription(): string
    {
        return match ($this) {
            // Yodel Services
            self::YODEL_WORLD_PACKET => 'Yodel World Packet',
            self::YODEL_WORLD_PARCEL => 'Yodel World Parcel',
            self::CI_48HR_POD => 'CI 48HR POD',
            self::CI_48_N_POD => 'CI 48 N.POD',
            self::XPECT_24_XL_POD => 'Xpect 24 (M-S) XL POD',
            self::XPECT_48_XL_POD => 'Xpect 48 XL POD',
            self::XPECT_48_RTN_POD => 'Xpect 48 RTN POD',
            self::XPECT_24_N_POD => 'Xpect 24 (M-S) N.POD',
            self::XPECT_48_POD => 'Xpect 48 (M-S) POD',
            self::XPECT_48_N_POD => 'Xpect 48 (M-S) N.POD',
            self::XPECT_48_XL_N_POD => 'Xpect 48 XL N.POD',
            self::XPRESS_24_POD => 'Xpress 24 POD',
            self::XPRESS_24_N_POD => 'Xpress 24 N.POD',
            self::XPRESS_48_POD => 'Xpress 48 POD',
            self::XPRESS_48_N_POD => 'Xpress 48 N.POD',
            self::XPRESS_MINI_N_POD => 'Xpress Mini N.POD',
            self::XPRESS_SP_48_N_POD => 'Xpress SP 48 N.POD',
            self::XPERT_24_ADDRESS_ONLY => 'XPERT 24 Address Only',
            self::XPECT_48_MINI_N_POD => 'Xpect 48 Mini N.POD',
            self::XPECT_48_MEDIUM_POD => 'Xpect 48 Medium Pod',
            self::XPECT_48_MEDIUM_N_POD => 'Xpect 48 Medium N.Pod',
            self::XPECT_24_MEDIUM_N_POD => 'Xpect 24 Medium N.Pod',
            self::XPECT_24_MEDIUM_POD => 'Xpect 24 Medium Pod',
            self::XPECT_24_XXL_POD => 'XPECT 24 XXL POD',
            self::XPECT_48_XXL_POD => 'XPECT 48 XXL POD',
            self::XPECT_24_XXL => 'XPECT 24 XXL',
            self::XPECT_48_XXL => 'XPECT 48 XXL',

            // Pro Carrier Services
            self::PRO_CARRIER_B2B => 'Pro Carrier B2B',
            self::PRO_CARRIER_PACKET => 'Pro Carrier Packet',
            self::PRO_CARRIER_PARCEL_POST => 'Pro Carrier Parcel Post',
            self::PRO_CARRIER_PLUS => 'Pro Carrier Plus',
            self::PRO_CARRIER_PLUS_EXPEDITED => 'Pro Carrier Plus Expedited',
            self::PRO_CARRIER_PARCEL_UK => 'Pro Carrier Parcel UK',
            self::PRO_CARRIER_PARCEL_EXPRESS => 'Pro Carrier Parcel Express',
            self::PRO_CARRIER_PARCEL_PUDO => 'Pro Carrier Parcel Pudo',
            self::PRO_CARRIER_PARCEL_PLUS_RETURNS => 'Pro Carrier Parcel Plus Returns',
            self::PRO_CARRIER_NEXT_DAY => 'Pro Carrier Next Day',
            self::PRO_CARRIER_UK_24 => 'Pro Carrier UK 24',
            self::PRO_CARRIER_UK_48 => 'Pro Carrier UK 48',
            self::PRO_CARRIER_UK_NEXT_DAY_1030 => 'Pro Carrier UK Next Day 10:30',
            self::PRO_CARRIER_NEXT_DAY_PRE_12 => 'Pro Carrier Next Day Pre 12',
            self::PRO_CARRIER_UK_SATURDAY => 'Pro Carrier UK Saturday',
            self::PRO_CARRIER_UK_SUNDAY => 'Pro Carrier UK Sunday',
            self::PRO_CARRIER_UK_BAG_IT => 'Pro Carrier UK Bag It',
            self::PRO_CARRIER_UK_LETTER => 'Pro Carrier UK Letter',
            self::PRO_CARRIER_DIRECT => 'Pro Carrier Direct',

            // Royal Mail Services
            self::TRACKED_24_NO_SIGNATURE => 'Tracked 24 No Signature',
            self::TRACKED_24_SIGNATURE => 'Tracked 24 Signature',
            self::TRACKED_48_NO_SIGNATURE => 'Tracked 48 No Signature',
            self::TRACKED_48_SIGNATURE => 'Tracked 48 Signature',
            self::INTERNATIONAL_BUSINESS_PARCELS_TRACKED => 'International Business Parcels Tracked',
            self::TRACKED_LETTER_BOXABLE_24_NO_SIGNATURE => 'Tracked Letter - Boxable 24 No Signature',
            self::TRACKED_LETTER_BOXABLE_24_SIGNATURE => 'Tracked Letter - Boxable 24 Signature',
            self::TRACKED_LETTER_BOXABLE_48_NO_SIGNATURE => 'Tracked Letter - Boxable 48 No Signature',
            self::TRACKED_LETTER_BOXABLE_48_SIGNATURE => 'Tracked Letter - Boxable 48 Signature',
        };
    }
}
