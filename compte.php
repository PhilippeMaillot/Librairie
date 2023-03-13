<table>
            <thead>
                <tr>
                    <th>
                        Nom
                    </th>
                    <th>
                        Email
                    </th>
                </tr>
            </thead>
            <tbody>
<?php
$connexion=new mysqli("localhost","root","","Biblio");
$requete="SELECT * FROM user";
$result=$connexion->query($requete);
foreach($result as $data){
    ?>
    <tr>
        <td>

     <?php echo $data['nom'];
     ?>
     </td>
     <td>

           <?php echo $data['email'];
           ?>
           </td>
           <td>
            <a href="modif.php?id=<?=$data['id']?>" rel="noopener noreferrer">Modifier</a>
           </td>
           <td>
                    <form action="suppr.php" method="get">
                        <input type="hidden" name="id" value="<?=$data['id']?>">
                        <input type="submit" value="supprimer">
                    </form>
            </td>
     </tr>
     <?php
}
?> 
</div>
</tbody>
</table>