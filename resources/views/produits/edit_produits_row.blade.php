<tr class="parcel_row">
    <td class="text-center">
        {{$produit->sku]}}
    </td>
    <td>
            <div>{{$produit->nom}}</div>
    </td>
    <input type="hidden" class="produit_id" value="{{$produit['id']}}" name="parcels[{{$row_index}}][produit_id]"/>
    <td class="text-center">
        <input type="text" name="produit[{{$row_index}}][qte]" class="form-control qte_produit" style="text-align: center;" value="1">
    </td>
    <td class="text-center">
        <input type="text" name="produit[{{$row_index}}][prix_unit]" class="form-control prix_unit_produit"  style="text-align: center;" value="{{$produit->prix}}">
    </td>

    <td class="text-center">
        <input type="text" readonly name="produit[{{$row_index}}][total_amount]" class="form-control parcels_total_amount" style="text-align: right;" value="{{$produit->prix}}">
    </td>
    <td class="text-center">
        <i class="fa fa-trash remove_produit_row cursor-pointer" aria-hidden="true"></i>
    </td>
</tr>