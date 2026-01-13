const atixSettings = window.wc.wcSettings.getSetting("atix_gateway_data", {});
const atixLabel =
  window.wp.htmlEntities.decodeEntities(atixSettings.title) ||
  window.wp.i18n.__("Atix Payment Services", "woocommerce-atix");
const atixContent = () => {
  return window.wp.htmlEntities.decodeEntities(atixSettings.description || "");
};

const LogoPayment = ({ url, label }) => {
  return React.createElement("img", {
    style: {
      height: "28px",
      verticalAlign: "middle"
    },
    src: url,
    alt: label,
  });
};

const IconPayment = ({ url, label }) => {
  return React.createElement("img", {
    style: { float: "right", marginRight: "20px", width: "120px" },
    src: url,
    alt: label,
  });
};

const CustomLabel = () => {
  const pluginUrl = (window.atixPluginData?.pluginUrl || '').replace(/\/+$/, '');;
  const logoUrl = `${pluginUrl}/assets/images/logoatix.png`;
  const iconUrl = `${pluginUrl}/assets/images/logos-credit-debit-cards-small.png`;


  return React.createElement(
    "div",
    { style: { width: "100%", display: "flex", alignItems: "center", justifyContent: "space-between" } },
    [
      LogoPayment({ url: logoUrl, label: atixLabel }),
      IconPayment({ url: iconUrl, label: atixLabel }),
    ]
  )
};

const Block_atix_Gateway = {
  name: "atix_gateway",
  label: Object(window.wp.element.createElement)(CustomLabel, null),
  content: Object(window.wp.element.createElement)(atixContent, null),
  edit: Object(window.wp.element.createElement)(atixContent, null),
  canMakePayment: () => true,
  ariaLabel: atixLabel,
  supports: {
    features: atixSettings.supports,
  },
};
window.wc.wcBlocksRegistry.registerPaymentMethod(Block_atix_Gateway);
