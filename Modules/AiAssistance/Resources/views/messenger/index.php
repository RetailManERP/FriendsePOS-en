

<?php $__env->startSection('title', __('aiassistance::lang.ai_messenger')); ?>

<?php $__env->startSection('css'); ?>
<style>
.aim-wrapper {
    display: flex;
    height: calc(100vh - 130px);
    background: #f8f9fa;
    overflow: hidden;
}

/* Sessions Panel */
.aim-sessions-panel {
    width: 320px;
    flex-shrink: 0;
    background: #fff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
}
.aim-sessions-header {
    padding: 16px;
    border-bottom: 1px solid #e5e7eb;
}
.aim-sessions-header h4 {
    margin: 0 0 10px;
    font-size: 1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
}
.aim-sessions-header h4 i { color: var(--bs-primary, #4f46e5); }
.aim-new-chat-btn {
    width: 100%;
    padding: 8px 14px;
    background: var(--bs-primary, #4f46e5);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: .85rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
}
.aim-new-chat-btn:hover { background: var(--theme-primary-dark, #4338ca); }
.aim-sessions-list {
    flex: 1;
    overflow-y: auto;
    padding: 8px 0;
}
.aim-session-item {
    padding: 10px 16px;
    border-bottom: 1px solid #f3f4f6;
    cursor: pointer;
    transition: background .15s;
}
.aim-session-item:hover { background: #f8f9fa; }
.aim-session-item.active { background: var(--theme-primary-light, #eff6ff); border-left: 3px solid var(--bs-primary, #4f46e5); }
.aim-session-item .aim-session-preview {
    font-size: .82rem;
    color: #374151;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.aim-session-item .aim-session-meta {
    font-size: .72rem;
    color: #9ca3af;
    margin-top: 2px;
}

/* Chat Panel */
.aim-chat-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #fff;
}
.aim-chat-header {
    padding: 14px 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.aim-chat-header h5 {
    margin: 0;
    font-size: .95rem;
    font-weight: 600;
}
.aim-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.aim-msg {
    max-width: 75%;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: .88rem;
    line-height: 1.5;
    word-wrap: break-word;
}
.aim-msg.user {
    align-self: flex-end;
    background: var(--bs-primary, #4f46e5);
    color: #fff;
    border-bottom-right-radius: 4px;
}
.aim-msg.assistant {
    align-self: flex-start;
    background: #f3f4f6;
    color: #1f2937;
    border-bottom-left-radius: 4px;
}
.aim-msg.assistant .aim-msg-content p { margin: 0 0 8px; }
.aim-msg.assistant .aim-msg-content p:last-child { margin-bottom: 0; }
.aim-msg.assistant .aim-msg-content ul,
.aim-msg.assistant .aim-msg-content ol { margin: 4px 0; padding-left: 20px; }
.aim-msg.assistant .aim-msg-content code {
    background: #e5e7eb;
    padding: 1px 5px;
    border-radius: 3px;
    font-size: .82rem;
}
.aim-msg-time {
    font-size: .68rem;
    opacity: .6;
    margin-top: 4px;
}

/* Module suggestion chips */
.aim-module-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 8px;
}
.aim-module-chip {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    background: var(--theme-primary-light, #dbeafe);
    color: var(--theme-primary-dark, #1e40af);
    border-radius: 12px;
    font-size: .75rem;
    font-weight: 600;
}
.aim-module-chip i { font-size: .7rem; }

/* Welcome screen */
.aim-welcome {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6b7280;
    text-align: center;
    padding: 40px;
}
.aim-welcome i { font-size: 3rem; color: var(--bs-primary, #4f46e5); margin-bottom: 16px; }
.aim-welcome h4 { color: #1f2937; margin-bottom: 8px; }
.aim-welcome .aim-quick-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 20px;
    justify-content: center;
}
.aim-quick-action {
    padding: 8px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    font-size: .82rem;
    cursor: pointer;
    transition: all .2s;
    background: #fff;
    color: #374151;
}
.aim-quick-action:hover { border-color: var(--bs-primary, #4f46e5); color: var(--bs-primary, #4f46e5); background: var(--theme-primary-light, #eef2ff); }

/* Typing indicator */
.aim-typing {
    display: none;
    align-self: flex-start;
    padding: 12px 18px;
    background: #f3f4f6;
    border-radius: 12px;
    border-bottom-left-radius: 4px;
}
.aim-typing span {
    display: inline-block;
    width: 8px;
    height: 8px;
    background: #9ca3af;
    border-radius: 50%;
    margin: 0 2px;
    animation: aimBounce 1.4s infinite;
}
.aim-typing span:nth-child(2) { animation-delay: .2s; }
.aim-typing span:nth-child(3) { animation-delay: .4s; }
@keyframes aimBounce {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
}

/* Input area */
.aim-input-area {
    padding: 14px 20px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    align-items: flex-end;
    gap: 10px;
}
.aim-input-area textarea {
    flex: 1;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 10px 14px;
    font-size: .88rem;
    resize: none;
    max-height: 120px;
    outline: none;
    transition: border-color .2s;
}
.aim-input-area textarea:focus { border-color: var(--bs-primary, #4f46e5); }
.aim-send-btn {
    width: 42px;
    height: 42px;
    border: none;
    background: var(--bs-primary, #4f46e5);
    color: #fff;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
    flex-shrink: 0;
}
.aim-send-btn:hover { background: var(--theme-primary-dark, #4338ca); }
.aim-send-btn:disabled { background: #9ca3af; cursor: not-allowed; }
.aim-escalate-btn {
    padding: 6px 14px;
    border: 1px solid #ef4444;
    background: #fff;
    color: #ef4444;
    border-radius: 8px;
    font-size: .78rem;
    cursor: pointer;
    transition: all .2s;
    flex-shrink: 0;
}
.aim-escalate-btn:hover { background: #fef2f2; }

@media (max-width: 768px) {
    .aim-sessions-panel { width: 100%; position: absolute; z-index: 10; }
    .aim-chat-panel { width: 100%; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="aim-wrapper">
    <!-- Sessions Sidebar -->
    <div class="aim-sessions-panel">
        <div class="aim-sessions-header">
            <h4><i class="fas fa-robot"></i> <?php echo e(__('aiassistance::lang.ai_messenger'), false); ?></h4>
            <button class="aim-new-chat-btn" onclick="aimNewChat()">
                <i class="fas fa-plus"></i> <?php echo e(__('aiassistance::lang.new_conversation'), false); ?>

            </button>
        </div>
        <div class="aim-sessions-list" id="aim-sessions-list">
            <?php $__empty_18 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                <div class="aim-session-item" data-session="<?php echo e($session->session_id, false); ?>" onclick="aimLoadSession('<?php echo e($session->session_id, false); ?>')">
                    <div class="aim-session-preview"><?php echo e(Str::limit($session->first_message, 50), false); ?></div>
                    <div class="aim-session-meta"><?php echo e($session->message_count, false); ?> messages &middot; <?php echo e(\Carbon\Carbon::parse($session->last_activity)->diffForHumans(), false); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <div class="text-center text-muted py-4" style="font-size:.85rem;">
                    <?php echo e(__('aiassistance::lang.no_conversations_yet'), false); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="aim-chat-panel" id="aim-chat-panel">
        <!-- Welcome screen (shown when no session is active) -->
        <div class="aim-welcome" id="aim-welcome">
            <i class="fas fa-robot"></i>
            <h4><?php echo e(__('aiassistance::lang.ai_messenger_welcome'), false); ?></h4>
            <p><?php echo e(__('aiassistance::lang.ai_messenger_welcome_desc'), false); ?></p>
            <div class="aim-quick-actions">
                <span class="aim-quick-action" onclick="aimQuickAsk(this)">How to create a sale?</span>
                <span class="aim-quick-action" onclick="aimQuickAsk(this)">How to add a new product?</span>
                <span class="aim-quick-action" onclick="aimQuickAsk(this)">What modules are available?</span>
                <span class="aim-quick-action" onclick="aimQuickAsk(this)">I need help with reports</span>
                <span class="aim-quick-action" onclick="aimQuickAsk(this)">How to manage inventory?</span>
                <span class="aim-quick-action" onclick="aimQuickAsk(this)">How to setup payment methods?</span>
            </div>
        </div>

        <!-- Messages area (hidden initially) -->
        <div class="aim-chat-messages d-none" id="aim-chat-messages">
        </div>

        <!-- Typing indicator -->
        <div class="aim-typing" id="aim-typing">
            <span></span><span></span><span></span>
        </div>

        <!-- Input area -->
        <div class="aim-input-area" id="aim-input-area">
            <textarea id="aim-input" rows="1" placeholder="<?php echo e(__('aiassistance::lang.type_your_question'), false); ?>" onkeydown="aimHandleKey(event)"></textarea>
            <button class="aim-escalate-btn" id="aim-escalate-btn" onclick="aimEscalate()" style="display:none;" title="<?php echo e(__('aiassistance::lang.escalate_to_admin'), false); ?>">
                <i class="fas fa-headset"></i> <?php echo e(__('aiassistance::lang.escalate'), false); ?>

            </button>
            <button class="aim-send-btn" id="aim-send-btn" onclick="aimSend()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    let aimSessionId = null;
    let aimSending = false;

    window.aimNewChat = function() {
        aimSessionId = null;
        document.getElementById('aim-welcome').classList.remove('d-none');
        document.getElementById('aim-chat-messages').classList.add('d-none');
        document.getElementById('aim-chat-messages').innerHTML = '';
        document.getElementById('aim-escalate-btn').style.display = 'none';
        document.getElementById('aim-input').value = '';
        document.querySelectorAll('.aim-session-item').forEach(el => el.classList.remove('active'));
    };

    window.aimLoadSession = function(sessionId) {
        aimSessionId = sessionId;
        document.getElementById('aim-welcome').classList.add('d-none');
        document.getElementById('aim-chat-messages').classList.remove('d-none');
        document.getElementById('aim-chat-messages').innerHTML = '';
        document.getElementById('aim-escalate-btn').style.display = 'inline-flex';

        document.querySelectorAll('.aim-session-item').forEach(el => {
            el.classList.toggle('active', el.dataset.session === sessionId);
        });

        // Load history
        $.ajax({
            url: '/aiassistance/messenger/history',
            data: { session_id: sessionId },
            success: function(messages) {
                messages.forEach(function(msg) {
                    aimAppendMessage(msg.role, msg.message, msg.created_at, msg.suggested_modules);
                });
                aimScrollToBottom();
            }
        });
    };

    window.aimQuickAsk = function(el) {
        document.getElementById('aim-input').value = el.textContent.trim();
        aimSend();
    };

    window.aimHandleKey = function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            aimSend();
        }
    };

    window.aimSend = function() {
        if (aimSending) return;

        var input = document.getElementById('aim-input');
        var message = input.value.trim();
        if (!message) return;

        // Show chat area if this is a new conversation
        document.getElementById('aim-welcome').classList.add('d-none');
        document.getElementById('aim-chat-messages').classList.remove('d-none');
        document.getElementById('aim-escalate-btn').style.display = 'inline-flex';

        // Append user message
        aimAppendMessage('user', message);
        input.value = '';
        aimAutoResize(input);

        // Show typing indicator
        aimSending = true;
        document.getElementById('aim-send-btn').disabled = true;
        document.getElementById('aim-typing').style.display = 'flex';
        aimScrollToBottom();

        $.ajax({
            url: '/aiassistance/messenger/chat',
            method: 'POST',
            data: {
                message: message,
                session_id: aimSessionId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                document.getElementById('aim-typing').style.display = 'none';
                aimSending = false;
                document.getElementById('aim-send-btn').disabled = false;

                if (data.success) {
                    aimSessionId = data.session_id;
                    aimAppendMessage('assistant', data.message, null, data.suggested_modules);
                    aimScrollToBottom();

                    // Refresh sessions list
                    aimRefreshSessions();
                } else {
                    aimAppendMessage('assistant', data.msg || 'Sorry, something went wrong. Please try again.');
                }
            },
            error: function() {
                document.getElementById('aim-typing').style.display = 'none';
                aimSending = false;
                document.getElementById('aim-send-btn').disabled = false;
                aimAppendMessage('assistant', 'Connection error. Please check your internet and try again.');
            }
        });
    };

    window.aimEscalate = function() {
        if (!aimSessionId) return;

        if (!confirm('<?php echo __("aiassistance::lang.escalate_confirm"); ?>')) return;

        $.ajax({
            url: '/aiassistance/messenger/escalate',
            method: 'POST',
            data: {
                session_id: aimSessionId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    aimAppendMessage('assistant', '✅ ' + data.msg);
                    aimScrollToBottom();
                } else {
                    toastr.error(data.msg || 'Failed to escalate');
                }
            },
            error: function() {
                toastr.error('Failed to escalate. Please try again.');
            }
        });
    };

    function aimAppendMessage(role, message, time, suggestedModules) {
        var container = document.getElementById('aim-chat-messages');
        var div = document.createElement('div');
        div.className = 'aim-msg ' + role;

        var contentHtml = '';
        if (role === 'assistant') {
            // Parse markdown-like formatting
            contentHtml = '<div class="aim-msg-content">' + aimFormatMessage(message) + '</div>';
        } else {
            contentHtml = aimEscapeHtml(message);
        }

        // Module suggestion chips
        var chipsHtml = '';
        if (suggestedModules && suggestedModules.length > 0) {
            chipsHtml = '<div class="aim-module-chips">';
            suggestedModules.forEach(function(mod) {
                var name = typeof mod === 'string' ? mod : mod.name;
                chipsHtml += '<span class="aim-module-chip"><i class="fas fa-puzzle-piece"></i> ' + aimEscapeHtml(name) + '</span>';
            });
            chipsHtml += '</div>';
        }

        var timeStr = time || new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        div.innerHTML = contentHtml + chipsHtml + '<div class="aim-msg-time">' + aimEscapeHtml(timeStr) + '</div>';
        container.appendChild(div);
    }

    function aimFormatMessage(text) {
        if (!text) return '';
        // Basic markdown conversion
        text = aimEscapeHtml(text);
        text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        text = text.replace(/\*(.*?)\*/g, '<em>$1</em>');
        text = text.replace(/`(.*?)`/g, '<code>$1</code>');
        text = text.replace(/\n\n/g, '</p><p>');
        text = text.replace(/\n(\d+)\.\s/g, '<br>$1. ');
        text = text.replace(/\n[-•]\s/g, '<br>• ');
        text = text.replace(/\n/g, '<br>');
        return '<p>' + text + '</p>';
    }

    function aimEscapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    function aimScrollToBottom() {
        var container = document.getElementById('aim-chat-messages');
        setTimeout(function() { container.scrollTop = container.scrollHeight; }, 50);
    }

    function aimAutoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
    }

    function aimRefreshSessions() {
        $.get('/aiassistance/messenger/sessions', function(sessions) {
            var list = document.getElementById('aim-sessions-list');
            if (!sessions.length) return;
            list.innerHTML = '';
            sessions.forEach(function(s) {
                var active = s.session_id === aimSessionId ? ' active' : '';
                var preview = s.first_message.length > 50 ? s.first_message.substring(0, 50) + '...' : s.first_message;
                list.innerHTML += '<div class="aim-session-item' + active + '" data-session="' + aimEscapeHtml(s.session_id) + '" onclick="aimLoadSession(\'' + aimEscapeHtml(s.session_id) + '\')">' +
                    '<div class="aim-session-preview">' + aimEscapeHtml(preview) + '</div>' +
                    '<div class="aim-session-meta">' + s.message_count + ' messages</div></div>';
            });
        });
    }

    // Auto-resize textarea
    document.getElementById('aim-input').addEventListener('input', function() {
        aimAutoResize(this);
    });
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>