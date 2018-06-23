<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class Master extends Migration
{
    public function up()
    {

        DB::statement('
            create view "data"."Master" as
            SELECT
                "Plan".*,

                "Part"."Name" as "PartName",
                "Part"."IsChemical" as "PartIsChemical",
                "Part"."StorageLife" as "PartStorageLife",
                "Part"."StorageConditions" as "PartStorageConditions",
                "Part"."Weight" as "PartWeight",
                "Part"."WeightUnit" as "PartWeightUnit",
                "Part"."Length" as "PartLength",
                "Part"."Width" as "PartWidth",
                "Part"."Height" as "PartHeight",

                "Part"."Material" as "PartMaterial",
                "Part"."Classification" as "PartClassification",
                "Part"."IsValuable" as "PartIsValuable",
                "Part"."IsVulnerable" as "PartIsVulnerable",

                "Line"."LinesidePlanner",
                "Line"."Name" as "LineName",

                "Supplier"."Name" as "SupplierName",
                "Supplier"."Address" as "SupplierAddress",
                "Supplier"."Nationality" as "SupplierNationality",
                "Supplier"."ShippingCity" as "SupplierShippingCity",
                "Supplier"."Distance" as "SupplierDistance",
                "Supplier"."DeliveryType" as "SupplierDeliveryType",
                "Supplier"."SupplyCycle" as "SupplierSupplyCycle",
                "Supplier"."ShippingTime" as "SupplierShippingTime",
                "Supplier"."ShippingType" as "SupplierShippingType",
                "Supplier"."EmergencyResponseTime" as "SupplierEmergencyResponseTime",
                "Supplier"."MinimumOrder" as "SupplierMinimumOrder",
                "Supplier"."Unit" as "SupplierUnit",
                "Supplier"."SafetyStock" as "SupplierSafetyStock"
            from "data"."Plan"
            left join "data"."Part"
                on "Part"."Id" = "Plan"."PartId"
            left join "data"."Line"
                on "Line"."Id" = "Plan"."LineId"
            left join "data"."Supplier"
                on "Supplier"."Id" = "Plan"."SupplierId"
            order by "Plan"."_id" desc
        ');
    }

    public function down()
    {
        DB::statement('drop view "data"."Master"');
    }
}
