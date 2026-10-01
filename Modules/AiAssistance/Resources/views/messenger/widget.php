


<style>
/* Floating button */
.aim-fab {
    position: fixed;
    bottom: 24px;
    right: 24px;
    width: 56px;
    height: 56px;
    background: var(--bs-primary, #4f46e5);
    color: #fff;
    border: none;
    border-radius: 50%;
    font-size: 1.4rem;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(var(--bs-primary-rgb, 79,70,229), .4);
    z-index: 9998;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .2s, box-shadow .2s;
}
.aim-fab:hover { transform: scale(1.08); box-shadow: 0 6px 24px rgba(var(--bs-primary-rgb, 79,70,229), .5); }
.aim-fab .aim-fab-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 18px;
    height: 18px;
    background: #ef4444;
    color: #fff;
    border-radius: 50%;
    font-size: .65rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

/* Chat popup */
.aim-widget {
    position: fixed;
    bottom: 90px;
    right: 24px;
    width: 380px;
    height: 520px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 40px rgba(0,0,0,.18);
    z-index: 9999;
    display: none;
    flex-direction: column;
    overflow: hidden;
}
.aim-widget.open { display: flex; }

.aim-widget-header {
    padding: 14px 16px;
    background: var(--bs-primary, #4f46e5);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}
.aim-widget-header h6 {
    margin: 0;
    font-size: .9rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}
.aim-widget-header-actions { display: flex; gap: 8px; }
.aim-widget-header-actions button {
    background: none;
    border: none;
    color: rgba(255,255,255,.8);
    cursor: pointer;
    font-size: .85rem;
    padding: 2px;
}
.aim-widget-header-actions button:hover { color: #fff; }

.aim-widget-messages {
    flex: 1;
    overflow-y: auto;
    padding: 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Reuse message styles */
.aim-widget .aim-w-msg {
    max-width: 85%;
    padding: 10px 13px;
    border-radius: 12px;
    font-size: .82rem;
    line-height: 1.45;
    word-wrap: break-word;
}
.aim-widget .aim-w-msg.user {
    align-self: flex-end;
    background: var(--bs-primary, #4f46e5);
    color: #fff;
    border-bottom-right-radius: 4px;
}
.aim-widget .aim-w-msg.assistant {
    align-self: flex-start;
    background: #f3f4f6;
    color: #1f2937;
    border-bottom-left-radius: 4px;
}
.aim-widget .aim-w-msg p { margin: 0 0 6px; }
.aim-widget .aim-w-msg p:last-child { margin: 0; }

/* Widget module chips */
.aim-w-chips { display: flex; flex-wrap: wrap; gap: 4px; margin-top: 6px; }
.aim-w-chip {
    padding: 2px 8px;
    background: var(--theme-primary-light, #dbeafe);
    color: var(--theme-primary-dark, #1e40af);
    border-radius: 10px;
    font-size: .68rem;
    font-weight: 600;
}

.aim-widget-typing {
    display: none;
    align-self: flex-start;
    padding: 10px 14px;
    background: #f3f4f6;
    border-radius: 12px;
    border-bottom-left-radius: 4px;
}
.aim-widget-typing span {
    display: inline-block;
    width: 6px;
    height: 6px;
    background: #9ca3af;
    border-radius: 50%;
    margin: 0 1px;
    animation: aimWBounce 1.4s infinite;
}
.aim-widget-typing span:nth-child(2) { animation-delay: .2s; }
.aim-widget-typing span:nth-child(3) { animation-delay: .4s; }
@keyframes aimWBounce {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
}

/* Quick start hints in widget */
.aim-widget-welcome {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    color: #6b7280;
}
.aim-widget-welcome i { font-size: 2rem; color: var(--bs-primary, #4f46e5); margin-bottom: 10px; }
.aim-widget-welcome h6 { color: #1f2937; margin-bottom: 6px; }
.aim-widget-welcome p { font-size: .78rem; margin-bottom: 12px; }
.aim-w-quick-btns {
    display: flex;
    flex-direction: column;
    gap: 6px;
    width: 100%;
}
.aim-w-quick-btn {
    padding: 8px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    font-size: .78rem;
    cursor: pointer;
    text-align: left;
    background: #fff;
    color: #374151;
    transition: all .15s;
}
.aim-w-quick-btn:hover { border-color: var(--bs-primary, #4f46e5); color: var(--bs-primary, #4f46e5); background: var(--theme-primary-light, #eef2ff); }

.aim-widget-input {
    padding: 10px 12px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    gap: 8px;
    align-items: flex-end;
    flex-shrink: 0;
}
.aim-widget-input textarea {
    flex: 1;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    padding: 8px 12px;
    font-size: .82rem;
    resize: none;
    max-height: 80px;
    outline: none;
}
.aim-widget-input textarea:focus { border-color: var(--bs-primary, #4f46e5); }
.aim-widget-input .aim-w-send {
    width: 36px;
    height: 36px;
    border: none;
    background: var(--bs-primary, #4f46e5);
    color: #fff;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: .8rem;
}
.aim-widget-input .aim-w-send:disabled { background: #9ca3af; cursor: not-allowed; }

@media (max-width: 480px) {
    .aim-widget {
        width: calc(100vw - 16px);
        right: 8px;
        bottom: 80px;
        height: 70vh;
    }
}
</style>

<!-- Floating Action Button -->
<button class="aim-fab" id="aim-fab" onclick="aimWidgetToggle()" title="<?php echo e(__('aiassistance::lang.ai_messenger'), false); ?>">
    <i class="fas fa-robot"></i>
</button>

<!-- Chat Widget Popup -->
<div class="aim-widget" id="aim-widget">
    <div class="aim-widget-header">
        <h6><i class="fas fa-robot"></i> <?php echo e(__('aiassistance::lang.ai_assistant'), false); ?></h6>
        <div class="aim-widget-header-actions">
            <button onclick="aimWidgetNewChat()" title="<?php echo e(__('aiassistance::lang.new_conversation'), false); ?>"><i class="fas fa-plus"></i></button>
            <button onclick="aimWidgetExpand()" title="<?php echo e(__('aiassistance::lang.open_full_view'), false); ?>"><i class="fas fa-expand-alt"></i></button>
            <button onclick="aimWidgetToggle()" title="Close"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <!-- Welcome screen -->
    <div class="aim-widget-welcome" id="aim-w-welcome">
        <i class="fas fa-robot"></i>
        <h6><?php echo e(__('aiassistance::lang.ai_messenger_welcome'), false); ?></h6>
        <p><?php echo e(__('aiassistance::lang.ai_messenger_widget_desc'), false); ?></p>
        <div class="aim-w-quick-btns">
            <span class="aim-w-quick-btn" onclick="aimWQuickAsk(this)">💡 How to create a sale?</span>
            <span class="aim-w-quick-btn" onclick="aimWQuickAsk(this)">📦 How to add a new product?</span>
            <span class="aim-w-quick-btn" onclick="aimWQuickAsk(this)">🧩 What addon modules are available?</span>
            <span class="aim-w-quick-btn" onclick="aimWQuickAsk(this)">📊 Help with reports</span>
            <span class="aim-w-quick-btn" onclick="aimWQuickAsk(this)">🛠️ I have a technical issue</span>
        </div>
    </div>

    <!-- Messages area -->
    <div class="aim-widget-messages d-none" id="aim-w-messages"></div>

    <!-- Typing indicator -->
    <div class="aim-widget-typing" id="aim-w-typing">
        <span></span><span></span><span></span>
    </div>

    <!-- Input -->
    <div class="aim-widget-input">
        <textarea id="aim-w-input" rows="1" placeholder="<?php echo e(__('aiassistance::lang.type_your_question'), false); ?>" onkeydown="aimWHandleKey(event)"></textarea>
        <button class="aim-w-send" id="aim-w-send" onclick="aimWSend()"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

<script>
(function() {
    var aimWSessionId = null;
    var aimWSending = false;

    window.aimWidgetToggle = function() {
        var widget = document.getElementById('aim-widget');
        widget.classList.toggle('open');
        if (widget.classList.contains('open')) {
            document.getElementById('aim-w-input').focus();
        }
    };

    window.aimWidgetNewChat = function() {
        aimWSessionId = null;
        document.getElementById('aim-w-welcome').classList.remove('d-none');
        document.getElementById('aim-w-messages').classList.add('d-none');
        document.getElementById('aim-w-messages').innerHTML = '';
        document.getElementById('aim-w-input').value = '';
    };

    window.aimWidgetExpand = function() {
        window.location.href = '/aiassistance/messenger';
    };

    window.aimWQuickAsk = function(el) {
        // Strip emoji prefix
        var text = el.textContent.trim().replace(/^[^\w]*/, '').trim();
        document.getElementById('aim-w-input').value = text;
        aimWSend();
    };

    window.aimWHandleKey = function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            aimWSend();
        }
    };

    window.aimWSend = function() {
        if (aimWSending) return;

        var input = document.getElementById('aim-w-input');
        var message = input.value.trim();
        if (!message) return;

        // Show messages area
        document.getElementById('aim-w-welcome').classList.add('d-none');
        document.getElementById('aim-w-messages').classList.remove('d-none');

        aimWAppendMsg('user', message);
        input.value = '';

        aimWSending = true;
        document.getElementById('aim-w-send').disabled = true;
        document.getElementById('aim-w-typing').style.display = 'flex';
        aimWScrollBottom();

        $.ajax({
            url: '/aiassistance/messenger/chat',
            method: 'POST',
            data: {
                message: message,
                session_id: aimWSessionId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                document.getElementById('aim-w-typing').style.display = 'none';
                aimWSending = false;
                document.getElementById('aim-w-send').disabled = false;

                if (data.success) {
                    aimWSessionId = data.session_id;
                    aimWAppendMsg('assistant', data.message, data.suggested_modules);
                    aimWScrollBottom();
                } else {
                    aimWAppendMsg('assistant', data.msg || 'Sorry, something went wrong.');
                }
            },
            error: function() {
                document.getElementById('aim-w-typing').style.display = 'none';
                aimWSending = false;
                document.getElementById('aim-w-send').disabled = false;
                aimWAppendMsg('assistant', 'Connection error. Please try again.');
            }
        });
    };

    function aimWAppendMsg(role, message, suggestedModules) {
        var container = document.getElementById('aim-w-messages');
        var div = document.createElement('div');
        div.className = 'aim-w-msg ' + role;

        var html = '';
        if (role === 'assistant') {
            html = aimWFormat(message);
        } else {
            html = aimWEscape(message);
        }

        var chips = '';
        if (suggestedModules && suggestedModules.length > 0) {
            chips = '<div class="aim-w-chips">';
            suggestedModules.forEach(function(m) {
                var name = typeof m === 'string' ? m : m.name;
                chips += '<span class="aim-w-chip">🧩 ' + aimWEscape(name) + '</span>';
            });
            chips += '</div>';
        }

        div.innerHTML = html + chips;
        container.appendChild(div);
    }

    function aimWFormat(text) {
        if (!text) return '';
        text = aimWEscape(text);
        text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        text = text.replace(/`(.*?)`/g, '<code>$1</code>');
        text = text.replace(/\n\n/g, '</p><p>');
        text = text.replace(/\n(\d+)\.\s/g, '<br>$1. ');
        text = text.replace(/\n[-•]\s/g, '<br>• ');
        text = text.replace(/\n/g, '<br>');
        return '<p>' + text + '</p>';
    }

    function aimWEscape(text) {
        var d = document.createElement('div');
        d.appendChild(document.createTextNode(text));
        return d.innerHTML;
    }

    function aimWScrollBottom() {
        var c = document.getElementById('aim-w-messages');
        setTimeout(function() { c.scrollTop = c.scrollHeight; }, 50);
    }

    // Auto-resize
    document.getElementById('aim-w-input').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 80) + 'px';
    });
})();
</script>


<div id="ai-smart-notif-container" style="position:fixed;bottom:90px;right:24px;z-index:9997;display:flex;flex-direction:column-reverse;gap:8px;max-width:340px;pointer-events:none;"></div>
<style>
.ai-smart-notif {
    background: #fff;
    border-radius: 12px;
    padding: 12px 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    border-left: 4px solid var(--bs-primary, #4F46E5);
    display: flex;
    align-items: flex-start;
    gap: 10px;
    animation: ai-notif-slide-in 0.4s ease-out;
    pointer-events: auto;
    cursor: pointer;
    transition: transform 0.2s, opacity 0.3s;
    max-width: 340px;
}
.ai-smart-notif:hover { transform: translateX(-4px); }
.ai-smart-notif.notif-warning { border-left-color: #f59e0b; }
.ai-smart-notif.notif-success { border-left-color: #10b981; }
.ai-smart-notif.notif-info { border-left-color: #3b82f6; }
.ai-smart-notif-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #fff;
    flex-shrink: 0;
    background: linear-gradient(135deg, var(--bs-primary, #4F46E5), var(--theme-primary-dark, #7C3AED));
}
.ai-smart-notif.notif-warning .ai-smart-notif-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
.ai-smart-notif.notif-success .ai-smart-notif-icon { background: linear-gradient(135deg, #10b981, #059669); }
.ai-smart-notif.notif-info .ai-smart-notif-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.ai-smart-notif-body { flex: 1; min-width: 0; }
.ai-smart-notif-title { font-weight: 700; font-size: 0.78rem; color: #1f2937; margin-bottom: 2px; }
.ai-smart-notif-msg { font-size: 0.72rem; color: #6b7280; line-height: 1.4; }
.ai-smart-notif-dismiss {
    position: absolute;
    top: 6px;
    right: 8px;
    background: none;
    border: none;
    color: #9ca3af;
    font-size: 12px;
    cursor: pointer;
    padding: 0;
    line-height: 1;
}
.ai-smart-notif-dismiss:hover { color: #4b5563; }
@keyframes ai-notif-slide-in {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}
html.dark-theme .ai-smart-notif { background: #1f2937; }
html.dark-theme .ai-smart-notif-title { color: #f3f4f6; }
html.dark-theme .ai-smart-notif-msg { color: #9ca3af; }
</style>
<script>
(function() {
    // AI Smart Notifications - load on dashboard only, with delay  
    var isDashboard = (window.location.pathname === '/' || window.location.pathname === '/home');
    var aiNotifShownKey = 'ai_notif_shown_' + new Date().toDateString();
    
    if (isDashboard && !sessionStorage.getItem(aiNotifShownKey)) {
        setTimeout(function() {
            fetch('<?php echo e(url("/aiassistance/bi/smart-notifications"), false); ?>', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success && data.notifications && data.notifications.length > 0) {
                    var container = document.getElementById('ai-smart-notif-container');
                    var shown = 0;
                    data.notifications.forEach(function(notif, idx) {
                        if (shown >= 3) return; // Max 3 notifications
                        setTimeout(function() {
                            var el = document.createElement('div');
                            el.className = 'ai-smart-notif notif-' + (notif.type || 'info');
                            el.style.position = 'relative';
                            el.innerHTML = 
                                '<div class="ai-smart-notif-icon"><i class="' + (notif.icon || 'fas fa-brain') + '"></i></div>' +
                                '<div class="ai-smart-notif-body">' +
                                    '<div class="ai-smart-notif-title">' + notif.title + '</div>' +
                                    '<div class="ai-smart-notif-msg">' + notif.message + '</div>' +
                                '</div>' +
                                '<button class="ai-smart-notif-dismiss" onclick="this.parentElement.style.opacity=0;setTimeout(function(){this.parentElement.remove()}.bind(this),300)">&times;</button>';
                            el.addEventListener('click', function(e) {
                                if (!e.target.classList.contains('ai-smart-notif-dismiss')) {
                                    window.location.href = notif.action || '<?php echo e(url("/aiassistance/bi"), false); ?>';
                                }
                            });
                            container.appendChild(el);
                            // Auto-dismiss after 12 seconds
                            setTimeout(function() {
                                if (el.parentElement) {
                                    el.style.opacity = '0';
                                    setTimeout(function() { el.remove(); }, 300);
                                }
                            }, 12000 + (idx * 2000));
                        }, (idx + 1) * 1500);
                        shown++;
                    });
                    sessionStorage.setItem(aiNotifShownKey, '1');
                }
            })
            .catch(function() { /* Silently fail */ });
        }, 3000); // 3 second delay after page load
    }
})();
</script>
