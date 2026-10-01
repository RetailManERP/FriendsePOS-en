<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo app('translator')->get('clinic::lang.queue_display'); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #1e3a5f 0%, #0d1b2a 100%); color: #fff; min-height: 100vh; }
        .header { background: rgba(0,0,0,0.3); padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 2rem; }
        .header .time { font-size: 1.5rem; }
        .content { padding: 30px 40px; }
        .now-serving { text-align: center; margin-bottom: 40px; }
        .now-serving h2 { font-size: 1.5rem; color: #64b5f6; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 3px; }
        .now-serving .number { font-size: 8rem; font-weight: bold; color: #4caf50; text-shadow: 0 0 30px rgba(76, 175, 80, 0.5); line-height: 1; }
        .now-serving .patient { font-size: 1.5rem; color: #e0e0e0; margin-top: 10px; }
        .now-serving .doctor { font-size: 1.1rem; color: #90caf9; }
        .waiting-section { margin-top: 30px; }
        .waiting-section h3 { font-size: 1.3rem; color: #ffd54f; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 2px; }
        .waiting-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 15px; }
        .waiting-card { background: rgba(255,255,255,0.1); border-radius: 12px; padding: 15px; text-align: center; backdrop-filter: blur(10px); }
        .waiting-card .q-num { font-size: 2rem; font-weight: bold; color: #fff; }
        .waiting-card .q-name { font-size: 0.8rem; color: #b0b0b0; margin-top: 5px; }
        .waiting-card.urgent { border: 2px solid #f44336; }
        .dept-section { margin-top: 30px; }
        .dept-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .dept-col { background: rgba(255,255,255,0.05); border-radius: 12px; padding: 20px; }
        .dept-col h4 { font-size: 1rem; color: #64b5f6; margin-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h1><i class="fas fa-clinic-medical"></i> <?php echo app('translator')->get('clinic::lang.queue_display'); ?></h1>
        <div class="time" id="current_time"></div>
    </div>

    <div class="content">
        
        <?php if($now_serving): ?>
            <div class="now-serving">
                <h2><?php echo app('translator')->get('clinic::lang.now_serving'); ?></h2>
                <div class="number"><?php echo e($now_serving->queue_number, false); ?></div>
                <div class="patient"><?php echo e($now_serving->patient->first_name ?? '', false); ?> <?php echo e($now_serving->patient->last_name ?? '', false); ?></div>
                <div class="doctor">
                    <?php if($now_serving->doctor): ?>
                        <?php echo app('translator')->get('clinic::lang.dr'); ?> <?php echo e($now_serving->doctor->first_name ?? '', false); ?> <?php echo e($now_serving->doctor->last_name ?? '', false); ?>

                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="now-serving">
                <h2><?php echo app('translator')->get('clinic::lang.now_serving'); ?></h2>
                <div class="number" style="color: #666;">---</div>
            </div>
        <?php endif; ?>

        
        <?php if($waiting->count()): ?>
            <div class="waiting-section">
                <h3><i class="fas fa-clock"></i> <?php echo app('translator')->get('clinic::lang.waiting'); ?> (<?php echo e($waiting->count(), false); ?>)</h3>
                <div class="waiting-grid">
                    <?php $__currentLoopData = $waiting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="waiting-card <?php echo e(in_array($w->priority, ['urgent','emergency']) ? 'urgent' : '', false); ?>">
                            <div class="q-num"><?php echo e($w->queue_number, false); ?></div>
                            <div class="q-name"><?php echo e($w->patient->first_name ?? '', false); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Update clock
        function updateTime() {
            var now = new Date();
            document.getElementById('current_time').textContent = now.toLocaleTimeString();
        }
        setInterval(updateTime, 1000);
        updateTime();

        // Auto-refresh every 15 seconds
        setTimeout(function() { location.reload(); }, 15000);
    </script>
</body>
</html>
