            {{ Form::inputText('name') }}
            {{ Form::inputSelect('year_id', $years) }}
            {{ Form::inputSelect2('feeamount_id', $feesamounts,$feesselected) }}

           