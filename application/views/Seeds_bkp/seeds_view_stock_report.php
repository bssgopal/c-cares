<div class="container">
    <div class="row">
     <div class="col-md-12">
         <div class="col-md-2">
         <?php $this->load->view($left_menu); ?>
         </div>
         <div class="col-md-10">
         <h4 align="center">Purchase</h4>
             <table id="purchase_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Invoice</th>
                <th>Company</th>
                <th>Kind & variety</th>
                <th>Quantity</th>
                <th>Value</th>
                <th>Lorry frieght</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
        <tbody>
        <?php
        if(!empty($stockreport)){
            foreach ($stockreport as $key => $stockvalue) {
                $sno = $key+1;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$stockvalue['invoice']."</td>";
                    echo "<td>".$stockvalue['company_name']."</td>";
                    echo "<td>".$stockvalue['material_type']."</td>";
                    echo "<td>".$stockvalue['quantity']."</td>";
                    echo "<td>".$stockvalue['value']."</td>";
                    echo "<td>".$stockvalue['lorry_frieght']."</td>";
                    echo "<td> <a href='".base_url()."Fertilizers/purchase/".md5($stockvalue['id'])."' ><span class='glyphicon glyphicon-pencil'></span></a></td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
         </div>
     </div>    
      </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
         $('#purchase_report').DataTable({  
                 "bFilter": true
         });
    });
</script>