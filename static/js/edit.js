/* 增加自定义功能 */
const items = [
  {
    title: '插入iframe视频',
    id: 'wmd-iframe-button',
    svg: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>',
  }
];

items.forEach(_ => {
    let btn = $(`<p><input value="${_.title}" type="button" id="${_.id}" onclick="insertIframeVideo()" /></p>`)
    $('.mono.url-slug').append(btn);
});

function insertIframeVideo(){
    $('body').append(
        '<div id="iframePanel">' +
        '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>' +
        '<div class="wmd-prompt-dialog">' +
        '<div>' +
        '<p><b>插入iframe视频地址</b></p>' +
        '<p style="color: #ff0012">bilibili粘贴iframe代码、抖音直接粘贴分享的文本</p>' +
        '<p style="color: #ff0012">其他视频地址需要附带网络协议（http/https）</p>' +
        '<p>请在下方的输入框内输入要插入的视频地址</p>' +
        '<p><input type="text" name="iframe_url"></input></p>' +
        '</div>' +
        '<form>' +
        '<button type="button" class="btn btn-s primary" id="iframe_ok">确定</button>' +
        '<button type="button" class="btn btn-s" id="iframe_cancel">取消</button>' +
        '</form>' +
        '</div>' +
        '</div>');
      $('.wmd-prompt-dialog input').val("http://").select();
}
$(document).on('click', '#awmd-iframe-button', function(){
    alert('11')
})

$(document).on('click', '#iframe_ok', function () {
  var iframe_url_str = $('.wmd-prompt-dialog input[name="iframe_url"]').val()
  var host_pattern = /([0-9a-z.]+)\//
  var host_url = host_pattern.exec(iframe_url_str)[0]
  var host = host_url.split('.').slice(-2).shift()
  
  switch (host) {
    case 'douyin':
      var dy_pattern = /https:\/\/(.*)\//
      var dy_iframe_url = dy_pattern.exec(iframe_url_str)[0]
      $('#text').insertContent('[VideoIframe]'+dy_iframe_url+'[/VideoIframe]');
      $(".vditor-reset").append(`<p data-block="0">[VideoIframe]${dy_iframe_url}[/VideoIframe]</p>`)
      $('#iframePanel').remove();
      $('textarea').focus();
      break;
    case 'bilibili':
      var b_pattern = /\/\/(.*)&page=1/
      var b_iframe_url = b_pattern.exec(iframe_url_str)[0]
      $('#text').insertContent('[VideoIframe]'+b_iframe_url+'[/VideoIframe]');
      $(".vditor-reset").append(`<p data-block="0">[VideoIframe]${b_iframe_url}[/VideoIframe]</p>`)
      $('#iframePanel').remove();
      $('textarea').focus();
      break;
    default:
      var o_pattern = /(https?:\/\/)([0-9a-z.]+)(:[0-9]+)?([/0-9a-z.]+)?(\?[0-9a-z&=]+)?(#[0-9-a-z]+)?/
      var iframe_url = o_pattern.exec(iframe_url_str)[0]
      $('#text').insertContent('[VideoIframe]'+iframe_url+'[/VideoIframe]');
      $(".vditor-reset").append(`<p data-block="0">[VideoIframe]${iframe_url}[/VideoIframe]</p>`)
      $('#iframePanel').remove();
      $('textarea').focus();
  }
})
$(document).on('click', '#iframe_cancel', function () {
  $('#iframePanel').remove();
  $('textarea').focus();
});

