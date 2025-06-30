<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Status</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($messages as $msg): ?>
        <tr>
            <td><?= $msg->name; ?></td>
            <td><?= $msg->email; ?></td>
            <td><?= $msg->subject; ?></td>
            <td><?= $msg->message; ?></td>
            <td><?= ucfirst($msg->status); ?></td>
            <td>
                <?php if($msg->status == 'pending'): ?>
                    <a href="<?= base_url('admin/contact/approve/'.$msg->id); ?>" class="btn btn-success btn-sm">Approve</a>
                <?php endif; ?>
                <a href="<?= base_url('admin/contact/delete/'.$msg->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
