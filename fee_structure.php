<?php
    include 'db_connect.php';
    $course = isset($_GET['course']) ? $_GET['course'] : 'Grade';
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card_body">
            <div class="row justify-content-center pt-4">
                <label for="" class="mt-2">Class</label>
                <div class="col-sm-3">
                    <select class="form-control" name="course" id="course" value="<?php echo $course ?>" >
                        <option value="">--Select Grade ---</option>
                        <option value=' '>All</option>
                        <?php
                            $fees = $conn->query("SELECT ef.* FROM courses ef order by ef.id asc ");
                            while($row= $fees->fetch_assoc()):
                               
                        ?>
                        <option value="<?php echo $row['course'] ?>" <?php echo isset($course) && $course == $row['course'] ? 'selected' : '' ?>><?php echo  ucwords($row['course']) ?></option>
                        <?php endwhile; ?>
                    </select>
                    
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <table class="table table-bordered" id='report-list'>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="">Description</th>
                            
                            <th class="">Course/Class.</th>
                            <th class="">Name</th>
                            <th class="">Amount</th>
                            <th >Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
			          <?php
                      $i = 1;
                      $total = 0;
                      $payments = $conn->query("SELECT p.*,ef.course,ef.level,ef.total_amount FROM fees p inner join courses ef on ef.id = p.course_id where ef.course LIKE '%".$course."%' and deleted_at is null");
                      if($payments->num_rows > 0):
			          while($row = $payments->fetch_array()):
                        $total += $row['amount'];
			          ?>
			          <tr>
                        <td class="text-center"><?php echo $i++ ?></td>
                        <td>
                            <p> <b><?php echo 'Term ' .$row['level'] ?></b></p>
                        </td>
                        
                        <td>
                            <p> <b><?php echo $row['course'] ?></b></p>
                        </td>
                        <td>
                            <p> <b><?php echo ucwords($row['description']) ?></b></p>
                        </td>
                        <td class="text-right">
                            <p> <b><?php echo number_format($row['amount'],2) ?></b></p>
                        </td>

                        <td class="text-right">
                            <p> <b><?php echo $row['description'] ?></b></p>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                        else:
                    ?>
                    <tr>
                            <th class="text-center" colspan="7">No Data.</th>
                    </tr>
                    <?php 
                        endif;
                    ?>
			        </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">Total</th>
                            <th class="text-right"><?php echo number_format($total,2) ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <hr>
                <div class="col-md-12 mb-4">
                    <center>
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                    </center>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<noscript>
	<style>
		table#report-list{
			width:100%;
			border-collapse:collapse
		}
		table#report-list td,table#report-list th{
			border:1px solid
		}
        p{
            margin:unset;
        }
		.text-center{
			text-align:center
		}
        .text-right{
            text-align:right
        }
	</style>
</noscript>
<script>
$('#course').change(function(){
    location.replace('index.php?page=fee_structure&course='+$(this).val())
})
$('#print').click(function(){
		var _c = $('#report-list').clone();
		var ns = $('noscript').clone();
            ns.append(_c)
		var nw = window.open('','_blank','width=900,height=600')
		nw.document.write('<p class="text-center"><b>Fee Structure</b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})
</script>