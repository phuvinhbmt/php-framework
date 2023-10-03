        <h3>Bank Transasctions from CSV </h3>
        <table>
            <tr>
                <th>Date</th>
                <th>Transaction Code</th>
                <th>Valid Transaction?</th>
                <th>Customer Number</th>
                <th>Reference</th>
                <th>Amount</th>
            </tr>
            <?php foreach ($this->viewData['transactions'] as $transaction ): ?>
                <tr>
                    <td><?php echo $transaction->getFormatDate()?></td>
                    <td><?php echo $transaction->getTransactionCode()?></td>
                    <td><?php echo $transaction->getValid()?></td>
                    <td><?php echo $transaction->getCustomerNo()?></td>
                    <td><?php echo $transaction->getReference()?></td>
                    <td><?php echo "<div id=" . $transaction->getType() . ">" . $transaction->getFormattedAmount() . "<div>" ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div id="footer"></div>
    </body>
</html>