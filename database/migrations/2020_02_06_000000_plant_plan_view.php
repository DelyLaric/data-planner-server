<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class PlantPlanView extends Migration
{
    public function up()
    {
        DB::statement('
            create view "data"."PlanView" as
            SELECT
                "Plan".*,

                "Part"."PartName",
                "Part"."PartDescription",
                "Part"."PartIsChemical",
                "Part"."PartStorageConditions",
                "Part"."PartStorageLife",
                "Part"."PartWeight",
                "Part"."PartWeightUnit",
                "Part"."PartLength",
                "Part"."PartWidth",
                "Part"."PartHeight",
                "Part"."PartMaterial",
                "Part"."PartClassification",
                "Part"."PartIsValuable",
                "Part"."PartIsVulnerable",

                "Line"."LineName",
                "Line"."LineManager",
                "Line"."LinePlanner",

                "LinesidePackage"."PackageLength" as "LinesidePackageLength",
                "LinesidePackage"."PackageWidth" as "LinesidePackageWidth",
                "LinesidePackage"."PackageHeight" as "LinesidePackageHeight"

            from "data"."Plan"
            left join "data"."Part"
                on "Part"."PartId" = "Plan"."PartId"
            left join "data"."Line"
                on "Line"."LineId" = "Plan"."LineId"
            left join "data"."Package" as "LinesidePackage"
                on "LinesidePackage"."PackageId" = "Plan"."LinesidePackageId"
            order by "Plan"."id" desc
        ');
    }

    public function down()
    {
        DB::statement('drop view "data"."PlanView"');
    }
}
