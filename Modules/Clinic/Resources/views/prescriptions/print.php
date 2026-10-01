<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo app('translator')->get('clinic::lang.prescription'); ?> - <?php echo e($prescription->prescription_ref, false); ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #2563eb; }
        .header p { margin: 5px 0; font-size: 12px; color: #666; }
        .rx-symbol { font-size: 28px; font-weight: bold; color: #2563eb; text-align: left; margin: 10px 0; }
        .patient-info { display: flex; justify-content: space-between; margin-bottom: 20px; padding: 10px; background: #f8f9fa; border-radius: 5px; }
        .patient-info div { flex: 1; }
        .patient-info label { font-weight: bold; font-size: 12px; color: #666; }
        .patient-info span { font-size: 14px; display: block; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 8px 12px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #2563eb; color: white; font-size: 12px; }
        td { font-size: 13px; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .footer { margin-top: 40px; text-align: center; font-size: 11px; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }
        .signature { margin-top: 50px; text-align: right; }
        .signature .line { border-top: 1px solid #333; width: 200px; display: inline-block; margin-top: 40px; }
        @media print {
            body { margin: 0; padding: 15px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 30px; background: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
            <i class="fas fa-print"></i> Print Prescription
        </button>
    </div>

    <div class="header">
        <?php if(!empty($settings['clinic_name'])): ?>
            <h1><?php echo e($settings['clinic_name'], false); ?></h1>
        <?php endif; ?>
        <?php if(!empty($settings['clinic_address'])): ?>
            <p><?php echo e($settings['clinic_address'], false); ?></p>
        <?php endif; ?>
        <?php if(!empty($settings['clinic_phone'])): ?>
            <p>Tel: <?php echo e($settings['clinic_phone'], false); ?> <?php if(!empty($settings['clinic_email'])): ?> | Email: <?php echo e($settings['clinic_email'], false); ?> <?php endif; ?></p>
        <?php endif; ?>
        <?php if(!empty($settings['prescription_header'])): ?>
            <p><?php echo $settings['prescription_header']; ?></p>
        <?php endif; ?>
    </div>

    <div class="patient-info">
        <div>
            <label>Patient Name:</label>
            <span><?php echo e($prescription->patient->first_name ?? '', false); ?> <?php echo e($prescription->patient->last_name ?? '', false); ?></span>
        </div>
        <div>
            <label>Patient ID:</label>
            <span><?php echo e($prescription->patient->patient_id_number ?? '', false); ?></span>
        </div>
        <div>
            <label>Age/Gender:</label>
            <span><?php echo e($prescription->patient->age ?? '-', false); ?> yrs / <?php echo e(ucfirst($prescription->patient->gender ?? ''), false); ?></span>
        </div>
        <div>
            <label>Date:</label>
            <span><?php echo e($prescription->created_at->format('d/m/Y'), false); ?></span>
        </div>
    </div>

    <div class="rx-symbol">&#8478;</div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Medicine</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Duration</th>
                <th>Route</th>
                <th>Instructions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $prescription->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i + 1, false); ?></td>
                    <td><strong><?php echo e($item->medicine_name, false); ?></strong></td>
                    <td><?php echo e($item->dosage, false); ?></td>
                    <td><?php echo e($item->frequency, false); ?></td>
                    <td><?php echo e($item->duration, false); ?> days</td>
                    <td><?php echo e(ucfirst($item->route), false); ?></td>
                    <td><?php echo e($item->instructions ?? '-', false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php if($prescription->notes): ?>
        <p><strong>Notes:</strong> <?php echo e($prescription->notes, false); ?></p>
    <?php endif; ?>

    <div class="signature">
        <p>Dr. <?php echo e($prescription->doctor->first_name ?? '', false); ?> <?php echo e($prescription->doctor->last_name ?? '', false); ?></p>
        <?php if($prescription->doctor->qualification): ?><p style="font-size: 12px; color: #666;"><?php echo e($prescription->doctor->qualification, false); ?></p><?php endif; ?>
        <?php if($prescription->doctor->license_number): ?><p style="font-size: 12px; color: #666;">Lic. <?php echo e($prescription->doctor->license_number, false); ?></p><?php endif; ?>
        <div class="line"></div>
        <p style="font-size: 11px; color: #666;">Doctor's Signature</p>
    </div>

    <div class="footer">
        <?php if(!empty($settings['prescription_footer'])): ?>
            <p><?php echo $settings['prescription_footer']; ?></p>
        <?php endif; ?>
        <p>Ref: <?php echo e($prescription->prescription_ref, false); ?> | Generated: <?php echo e(now()->format('d/m/Y h:i A'), false); ?></p>
    </div>
</body>
</html>
